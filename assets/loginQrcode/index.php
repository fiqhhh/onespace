<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Scan</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://kit.fontawesome.com/13838d8737.js" crossorigin="anonymous"></script>
  <!-- <link href="scanner/css/style.css" rel="stylesheet"> -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="scanner/vendor/modernizr/modernizr.js"></script>
  <script src="scanner/vendor/vue/vue.min.js"></script>
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: Arial;
      font-size: 17px;
    }

    .preview {
      position: relative;
      right: 0;
      bottom: 0;
      min-width: 100%;
      min-height: 80%;
      border-radius: 0px 0px 20px 20px;

    }

    .content {
      position: fixed;
      bottom: 0;
      background: rgba(0, 0, 0, 0.5);
      color: #f1f1f1;
      width: 100%;
      border-radius: 0px 0px 20px 20px;
      padding: 20px;
    }

    #myBtn {
      width: 200px;
      font-size: 18px;
      padding: 10px;
      border: none;
      background: #000;
      color: #fff;
      cursor: pointer;
    }

    #myBtn:hover {
      background: #ddd;
      color: black;
    }
  </style>
</head>

<body>
  <div>
    <video id="preview" class="preview">
    </video>
  </div>
  <div class="container-fluid">
    <div class="row d-flex justify-content-center">
      <div class="col-md-12 justify-content-center text-center">
        <h5>Scan Disini Untuk Absen</h5>
      </div>
    </div>
    <div class="row d-flex justify-content-center">
      <div id="app" class="col-md-12 justify-content-center text-center">
        <div v-for="camera in cameras" id="id_work_days">
          <span v-if="camera.id == activeCameraId" :title="formatName(camera.name)" class="active">
            <input type="checkbox" class="align-middle mr-1" checked> {{ formatName(camera.name) }}
          </span>
          <span v-if="camera.id != activeCameraId" :title="formatName(camera.name)">
            <a @click.stop="selectCamera(camera)">
              <input type="checkbox" class="align-middle mr-1">{{ formatName(camera.name) }}
            </a>
          </span>
        </div>
      </div>
    </div>
    <div class="row d-flex justify-content-center">
      <div class="col-md-12 justify-content-center text-center">
        <form action="" method="POST" id="myForm">
          <fieldset class="scheduler-border">
            <input type="hidden" name="qrcode" id="code" autofocus>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
  <script src="scanner/js/app.js"></script>
  <script src="scanner/vendor/instascan/instascan.min.js"></script>
  <script src="scanner/js/scanner.js"></script>
  <script>
    var video = document.getElementById("myVideo");
    var btn = document.getElementById("myBtn");

    function myFunction() {
      if (video.paused) {
        video.play();
        btn.innerHTML = "Pause";
      } else {
        video.pause();
        btn.innerHTML = "Play";
      }
    }
  </script>
</body>

</html>