const pdfState = {
  loaded: false,
  loading: false,
  blobUrl: null,
  iframeHasBeenLoaded: false,
  failedAttempts: 0,
  loadingLaunchedByIframe: false
};

function dispatchPdfLoadingFinished(success = true) {
  const pdfLoadingFinished = new CustomEvent('pdfLoadingFinished', {
    detail: {success: success}
  });
  document.dispatchEvent(pdfLoadingFinished);
}

async function fetchPDF(pdfUrl) {
  pdfState.loading = true;
  return fetch(pdfUrl)
    .then(response => {
      if (!response.ok) {
      	pdfState.loading = false;
        pdfState.failedAttempts++;
      	throw new Error("error");
      }
      return response.blob();
    })
    .then(blob => {
      pdfState.blobUrl = URL.createObjectURL(blob);
      pdfState.loaded = !!pdfState.blobUrl;
      dispatchPdfLoadingFinished(pdfState.loaded);
      pdfState.loading = false;
    });
}

function tillPdfLoad() {
  return new Promise((resolve) => {
    const timer = setTimeout(() => {
      resolve();
    }, 10000);
    document.addEventListener('pdfLoadingFinished', (event) => {
      clearTimeout(timer);
      resolve();
    }, { once: true });
  });
}

async function toggleViewer() {
  const viewer = document.getElementById('pdf-viewer');
  const eyeOpen = document.getElementById('eye-open');
  const eyeClosed = document.getElementById('eye-closed');
  const toggleText = document.getElementById('toggleTextSee');
  if (viewer.style.display === 'none' || viewer.style.display === '') {
    viewer.style.display = 'block';
    viewer.focus();
    toggleText.textContent = 'Ocultar PDF';
    eyeOpen.classList.remove('active');
    eyeClosed.classList.add('active');
    loadPDF();
  } else {
    viewer.style.display = 'none';
    toggleText.textContent = 'Ver Online';
    eyeClosed.classList.remove('active');
    eyeOpen.classList.add('active');
  }
}

async function loadPDF() {
  scrollWindowToTopOf(document.getElementById('toggleBtn'), 5);
  if (pdfState.failedAttempts >= 3) {
    return;
  }
  const loading = document.getElementById('pdf-loading');
  const errorLoading = document.getElementById('pdf-loading-error');
  let pdfUrl = '';
  let iframeUrl = '/public/pdfjs/web/viewer.html?file=';
  if (!pdfState.loaded) {
    loading.classList.remove('hidden');
    errorLoading.classList.add('hidden');
    loading.focus();
    if (pdfState.loading) {
      await tillPdfLoad();
      if (!pdfState.loaded) {
        if (pdfState.failedAttempts >= 3) {
          showErrorLoading(loading, errorLoading);
          return;
        }
        try {
          await fetchPDF(pU);
         } catch (error) {
          showErrorLoading(loading, errorLoading);
          pdfState.failedAttempts++;
          return;
        }
      }
      pdfUrl = pdfState.blobUrl + '#page=1';
    } else {
      pdfState.loading = true;
      pdfState.loadingLaunchedByIframe = true;
      pdfUrl = pU + '#page=1';
      window.addEventListener('message', setPdfFromIframe);
    }
  }
  iframeUrl = !pdfUrl ? iframeUrl + pU + '#page=1' : iframeUrl + pdfUrl;
  loadIframe(iframeUrl, loading, errorLoading);
}

async function scrollWindowToTopOf(element, marginTop = 0) {
  const distance = element.getBoundingClientRect().top - marginTop;
  if (distance <= 0) return
  window.scrollTo({
      top: (distance + window.scrollY), 
      behavior: 'smooth'
  });
}

function loadIframe(iframeUrl, loading, errorLoading) {
  const iframe = document.getElementById('pdf-iframe');
  if (pdfState.iframeHasBeenLoaded) {
    iframe.focus();
    return;
  }
  iframe.onerror = function() {
    showErrorLoading(loading, errorLoading);
    errorLoading.focus();
    dispatchPdfLoadingFinished(false);
    if (pdfState.loadingLaunchedByIframe) {
      pdfState.loading=false;
      pdfState.loadingLaunchedByIframe=false;
    }
    pdfState.iframeHasBeenLoaded = false;
  };
  document.addEventListener('pdfloaded-error', async () => {
    showErrorLoading(loading, errorLoading);
    errorLoading.focus();
    pdfState.failedAttempts++;
    dispatchPdfLoadingFinished(false);
    if (pdfState.loadingLaunchedByIframe) {
      pdfState.loading=false;
      pdfState.loadingLaunchedByIframe=false;
    }
    pdfState.iframeHasBeenLoaded = false;
  }, {once: true});
  document.addEventListener("pdfloaded", async () => {
    loading.classList.add('hidden');
    errorLoading.classList.add('hidden');
    pdfState.iframeHasBeenLoaded = true;
    iframe.focus();
  }, {once: true});
  iframe.src = iframeUrl;
}

/*async function scrollToTop(target, offset, speedDvhPerSecond) {
  const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - offset;
  const startPosition = window.pageYOffset;
  const distance = targetPosition - startPosition; 

  if (distance <= 0) { 
      return;
  }
  const viewportHeight = window.innerHeight;
  const pixelsPerDvh = viewportHeight / 100;
  const speedPxPerSecond = speedDvhPerSecond * pixelsPerDvh;
  let duracao = (distance / speedPxPerSecond) * 1000;
  duracao = Math.min(2000, Math.max(300, duracao));

  let startTime = null;
  const easingOutQuart = t => 1 - (--t) * t * t * t;

  function animate(currentTime) {
    if (startTime === null) startTime = currentTime;
    const timeElapsed = currentTime - startTime;
    const progress = Math.min(timeElapsed / duracao, 1);
    const easedProgress = easingOutQuart(progress);
    window.scrollTo(0, startPosition + (targetPosition - startPosition) * easedProgress);
    if (timeElapsed < duracao) {
      requestAnimationFrame(animate);
    }
  }
  requestAnimationFrame(animate);
}*/

function showErrorLoading(loading, errorLoading) {
  loading.classList.add('hidden');
  errorLoading.classList.remove('hidden');
}

function setPdfFromIframe(event) {
  if (event.data.type !== 'PDF_FILE') {
    return;
  }
  const ev=event.origin;
  if (ev !== 'http://<web-site-link> && ev !== 'https://<web-site-link>') return;
  const pdf = event.data.pdf;
  pdfState.loading = false;
  pdfState.loaded = !!pdf;
  if (!pdfState.loaded) {
    dispatchPdfLoadingFinished(false);
  } else {
    const blob = new Blob([pdf], { type: 'application/pdf' });
    pdfState.blobUrl = URL.createObjectURL(blob);
    dispatchPdfLoadingFinished(true);
  }
  window.removeEventListener('message', setPdfFromIframe);
}

async function downloadPDF() {
  if (pdfState.failedAttempts >= 3) {
    return;
  }
  const button = document.getElementById("download-btn");
  const spinner = document.getElementById("spinner-download");
  button.disabled = true;
  button.classList.add('loading');
  spinner.style.display='block';
  if (!pdfState.loaded) {
    const errorDownload = document.getElementById("download-error");
    errorDownload.style.opacity='0';
    if (pdfState.loading) {
      await tillPdfLoad();
      if (!pdfState.loaded && pdfState.failedAttempts >= 3 || !(await couldFetchPdf(pU))) {
        handleDownloadError(button, spinner, errorDownload);
        return;
      }
    } else if (pdfState.failedAttempts >= 3 || !(await couldFetchPdf(pU))) {
      handleDownloadError(button, spinner, errorDownload);
      return;
    }
  }
  const link = document.createElement('a');
  link.href = pdfState.blobUrl;
  link.download = ifsn + '.pdf';
  link.click();
  hideDownloadLoading(button, spinner);
}

function couldFetchPdf(pdfUrl) {
  return fetchPDF(pdfUrl)
    .then(() => {
      return true;
    })
    .catch(() => {
      return false;
    });
}

function hideDownloadLoading(button, spinner) {
  button.classList.remove('loading');
  spinner.style.display='none';
  button.disabled = false;
}

function handleDownloadError(button, spinner, errorDownload) {
  hideDownloadLoading(button, spinner);
  errorDownload.style.opacity='1';
  setTimeout(() => {
    errorDownload.style.opacity = '0'; 
  }, 2500);
}

document.addEventListener("webviewerloaded", async () => {
  let pdfViewerIFrame = document.getElementById("pdf-iframe");
  pdfViewerIFrame.contentWindow.PDFViewerApplicationOptions.set("viewerCssTheme", 1);
});
