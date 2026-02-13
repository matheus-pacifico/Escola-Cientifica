const pdfCache = new Map();

function put(ifsn, blobUrl) {
  pdfCache.set(ifsn, { blobUrl: blobUrl, failtries: 0 });
}

async function downloadPDF(ifsn, pdfUrl) {
  if (!pdfCache.get(ifsn)) {
    if (pdfCache.size >= 5) {
      const oldest = removeFirst(pdfCache);
      if (oldest !== undefined) {
        URL.revokeObjectURL(oldest.blobUrl);
      }
    }
    put(ifsn, null);
    try {
      download(pdfUrl + '?forcedownload=1&n=' + ifsn, (ifsn + '.pdf'));
    } catch {
      increaseFailTries(ifsn);
    }
    return;
  }
  if (pdfCache.get(ifsn).failtries >= 2) {
    return;
  }
  if (!pdfCache.get(ifsn).blobUrl) {
    fetch(pdfUrl)
      .then(response => {
        if (!response.ok) {
          increaseFailTries(ifsn);
          throw new Error("error");
        }
        return response.blob();
      })
      .then(blob => {
        pdfCache.get(ifsn).blobUrl = URL.createObjectURL(blob);
      })
      .catch(() => {
        increaseFailTries(ifsn);
        return;
      });
  }
  download(pdfCache.get(ifsn).blobUrl, ifsn + '.pdf');
}

function download(link, name) {
  const a = document.createElement('a');
  a.href = link;
  a.download = name;
  a.click();
}

function increaseFailTries(ifsn) {
  pdfCache.get(ifsn).failtries++;
}