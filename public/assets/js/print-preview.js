function printPreview(src) {
    var barcode = document.getElementById('barcode').src;
    var printWindow = window.open('', 'Print Preview');
    printWindow.document.write('<html><head><title>Print Preview</title></head><body><div style="margin-top: 45px; margin-left: 10px;"><img src="' + src + '"></div></body></html>');
    printWindow.document.close();

    printWindow.focus();
    printWindow.print();
    printWindow.close();
}