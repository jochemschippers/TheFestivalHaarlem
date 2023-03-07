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
  <form>
      <label for="ticketNumber">Ticket Number:</label>
      <input type="text" id="ticketNumber" name="ticketNumber" readonly><br><br>
      <button type="button" id="scanButton">Scan QR Code</button>
    </form>
  
    
    <br>
    <video id="preview" style="display:none;"></video>
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script type="text/javascript">


      let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
      scanner.addListener('scan', function (content) {
        console.log(content);
        let ticketNumber = document.getElementById('ticketNumber');
        if (content == '1234') {
          ticketNumber.value = content;
          ticketNumber.classList.remove('red-box');
          ticketNumber.classList.add('green-box');
        } else {
          ticketNumber.value = '';
          ticketNumber.classList.remove('green-box');
          ticketNumber.classList.add('red-box');
        }
      });



      document.getElementById('scanButton').addEventListener('click', function() {
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
      });
    </script>
  </body>
</html>