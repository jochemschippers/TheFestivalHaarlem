<script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>

<!DOCTYPE html>
<html>
  <head>
    <title>Employee Ticket Scanner</title>
    <link href="../css/qrscanner.css" rel="stylesheet">
    </head>
  <body>
  <div class = "container">
    <div class="row">
    <form>
      <label for="ticketNumber">Ticket Number:</label>
      <input type="text" id="ticketNumber" name="ticketNumber" readonly><br><br>
    </form>
    </div>
    <div class="row">
    <video id="preview"></video>
    </div>
    <div class="row">
    <img id="correctImage" src="\image\qrscanner\green check.png" alt="Correct" >
    <img id="incorrectImage" src="\image\qrscanner\redcross.png" alt="Incorrect" >
    </div>
  </div>
    <br>
    
    <script type="text/javascript">
      let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
      let correctImage = document.getElementById('correctImage');
    let incorrectImage = document.getElementById('incorrectImage');
    Instascan.Camera.getCameras().then(function (cameras) {
    if (cameras.length > 0) {
      scanner.start(cameras[0]);
      document.getElementById('preview').style.display = 'block';
    } else {
      console.error('No cameras found.');
    }
    }).catch(function (e) {
      console.error(e);
    });


    scanner.addListener('scan', function (content) {
    console.log(content);
    if (content == '1234') {
      correctImage.style.display = 'block';
      ticketNumber.value = content;
      incorrectImage.style.display = 'none';
    } else {
      correctImage.style.display = 'none';
      ticketNumber.value = content;
      incorrectImage.style.display = 'block';
  }
});
    </script>
  </body>
</html>