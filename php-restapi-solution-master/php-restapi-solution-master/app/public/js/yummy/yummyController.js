setTimeout(function() {
    var successMessage = document.getElementById('successMessage');
    if (successMessage) {
        successMessage.style.display = 'none';
    }
    var errorMessage = document.getElementById('errorMessage');
    if (errorMessage) {
        errorMessage.style.display = 'none';
    }
    var errorMsg = document.getElementById('errorMsg');
    if (errorMsg) {
        errorMsg.style.display = 'none';
    }
}, 5000);