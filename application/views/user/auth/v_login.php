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
    <script src="<?= base_url('assets/loginQrcode/') ?>scanner/css/style.css"></script>
    <script src="<?= base_url('assets/loginQrcode/') ?>js/jquery-3.4.1.min.js"></script>
    <script src="<?= base_url('assets/loginQrcode/') ?>scanner/vendor/modernizr/modernizr.js"></script>
    <script src="<?= base_url('assets/loginQrcode/') ?>scanner/vendor/vue/vue.min.js"></script>
</head>

<body>
    <div>

        


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
                <form action="<?= base_url('Masuk/') ?>" method="POST" id="myForm">
                    <select name="" id="">
                        <option value="3">Siswa</option>
                        <option value="4">Guru</option>
                        <option value="5">Orang Tua</option>
                    </select>
                    <input type="text" name="nisn_murid" id="code" autofocus>
                </form>
            </div>
        </div>
    </div>
    <script src="<?= base_url('assets/loginQrcode/') ?>scanner/js/app.js"></script>
    <script src="<?= base_url('assets/loginQrcode/') ?>scanner/vendor/instascan/instascan.min.js"></script>
    <script src="<?= base_url('assets/loginQrcode/') ?>scanner/js/scanner.js"></script>
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