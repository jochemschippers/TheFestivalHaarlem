let url = new URL(window.location.href);

let share = url.searchParams.get('share');
//resets for only if not sharable link (only for user who paid)
if (share !== 'true' || share === null) {
    sessionStorage.setItem('personalProgram', []);
    //resets for view
    personalProgram = [];
    updateCartItemDisplay()
}

fetch('/paymentpage/getQRCode', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json'
    },
    body: JSON.stringify({
        url: window.location.href + "&share=true"
    })
})
.then(response => response.json())
.then(data => {
    // Hide the loading animation.
    document.getElementById('loader').style.display = 'none';
    if (data.qrImage) {
        // Show the QR code image.
        const qrCode = document.getElementById('qr-code');
        qrCode.src = data.qrImage;
        qrCode.style.display = 'block';
    }
});
