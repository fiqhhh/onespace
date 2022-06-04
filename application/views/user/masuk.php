<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link rel="icon" type="text/css" href="<?= base_url('assets/img/icon/w-icons.png') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/templateuser/css/app.css'); ?>">

</head>
<body class="font-sans antialiased bg-gray-100 text-secondary-300">

    <main class="container px-8 mx-auto">

        <header class="flex mt-5 justify-items-start">
            <a href="<?= base_url('home/'); ?>" class="p-1 transition duration-100 border-2 border-transparent rounded-primary focus:border-secondary-300">
                <svg class="w-6 stroke-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            </a>
        </header>

        <?= $this->session->flashdata('message'); ?>

        <!-- placeholder camera -->
        
        <section class="mt-6">
            <form action="<?= base_url('home/proses_masuk') ?>" id="myForm" method="post" autocomplete="off">
                <span class="text-lg font-bold">Pindai QR Code</span>

                <div id="default" class="w-full h-auto p-4 mt-2 border-2 border-b-8 border-secondary-300 rounded-primary">
                    <div class="flex items-center w-full h-64 place-content-center bg-secondary-300 rounded-primary">
                        <p class="text-xl font-bold text-center text-white">Pilih Privillege Terlebih Dahulu!</p>
                    </div>
                </div>

                <!-- Guru -->
                <div id="guruNip" style="display:none;"> 
                    <div class="w-full h-auto p-4 mt-2 border-2 border-b-8 border-secondary-300 rounded-primary">
                        <video id="preview_guru" class="flex items-center w-full h-64 place-content-center bg-secondary-300 rounded-primary"></video>
                        <input id="code_guru" type="hidden" name="nip_guru">
                    </div>
                </div>
                <div id="muridNisn" style="display:none;"> 
                    <div class="w-full h-auto p-4 mt-2 border-2 border-b-8 border-secondary-300 rounded-primary">
                        <video id="preview_murid" class="flex items-center w-full h-64 place-content-center bg-secondary-300 rounded-primary"></video>
                        <input class="form-control" id="code_murid" type="hidden" name="nisn_murid">
                    </div>
                </div>
                <div id="ortuNisn" style="display:none;"> 
                    <div class="w-full h-auto p-4 mt-2 border-2 border-b-8 border-secondary-300 rounded-primary">
                        <video id="preview_ortu" class="flex items-center w-full h-64 place-content-center bg-secondary-300 rounded-primary">
                        </video>
                        <input class="form-control" id="code_ortu" type="hidden" name="nisn_anak">
                    </div>
                </div>


                <!-- Murid -->

            </form>
        </section>

        <section class="mt-6">
            <span class="text-lg font-bold">Privillege</span>
            <select class="w-full mt-2 p-3 text-sm font-medium bg-transparent border-2  placeholder-secondary-300 border-secondary-300 focus:outline-none focus:bg-gray-200 rounded-primary" name="privillege" id="privillege" onChange="tampilInput(this)">
                <option selected="" disabled="">Pilih</option>
                <option value="1">Guru</option>
                <option value="2">Murid</option>
                <option value="3">Orang Tua</option>
            </select>
        </section>

    </main>

    <script src="<?= base_url('assets/loginQrcode/js/jquery-3.4.1.min.js'); ?>"></script>
    <script src="<?= base_url('assets/loginQrcode/scanner/js/app.js'); ?>"></script>
    <script src="<?= base_url('assets/loginQrcode/scanner/vendor/vue/vue.min.js'); ?>"></script>
    <script src="<?= base_url('assets/loginQrcode/scanner/vendor/modernizr/modernizr.js'); ?>"></script>
    <script src="<?= base_url('assets/loginQrcode/scanner/vendor/instascan/instascan.min.js'); ?>"></script>

    <script type="text/javascript">

        // Button
        function tampilInput(value) {

            var st = $("#privillege").val();

            // Guru
            if (st == "1") {
                var g = function () {
                    var app;
                    var route = "Shopping/getPro/";

                    app = new Vue({
                        el: "#app",
                        data: {
                            scanner: null,
                            activeCameraId: null,
                            cameras: [],
                            scans: [],
                        },
                        mounted: function () {
                            var self;
                            self = this;
                            self.scanner = new Instascan.Scanner({
                                video: document.getElementById("preview_guru"),
                                scanPeriod: 3,
                                mirror: true,
                            });
                            self.scanner.addListener("scan", function (content, image) {
                                $("#code_guru").val(content);
                                document.getElementById("myForm").submit();
                            });
                            return Instascan.Camera.getCameras()
                            .then(function (cameras) {
                                self.cameras = cameras;
                                if (cameras.length > 0) {
                                    if (cameras[0]) {
                                        self.activeCameraId = cameras[0].id;
                                        return self.scanner.start(cameras[0]);
                                    } else {
                                        self.activeCameraId = cameras[0].id;
                                        return self.scanner.start(cameras[0]);
                                    }
                                } else {
                                    return console.error("No cameras found.");
                                }
                            })
                            .catch(function (e) {
                                return console.error(e);
                            });
                        },
                        methods: {
                            formatName: function (name) {
                                return name || "(unknown)";
                            },
                            selectCamera: function (camera) {
                                this.activeCameraId = camera.id;
                                return this.scanner.start(camera);
                            },
                        },
                    });
                }.call(this);

                $('#code_guru').attr('disabled',false);
                $('#code_murid').attr('disabled',true);
                $('#code_ortu').attr('disabled',true);

                document.getElementById("default").style.display = 'none';
                document.getElementById("guruNip").style.display = 'block';
                document.getElementById("muridNisn").style.display = 'none';
                document.getElementById("ortuNisn").style.display = 'none';

            } else if (st == "2") {

                var m = function () {
                    var app;
                    var route = "Shopping/getPro/";

                    app = new Vue({
                        el: "#app",
                        data: {
                            scanner: null,
                            activeCameraId: null,
                            cameras: [],
                            scans: [],
                        },
                        mounted: function () {
                            var self;
                            self = this;
                            self.scanner = new Instascan.Scanner({
                                video: document.getElementById("preview_murid"),
                                scanPeriod: 3,
                                mirror: true,
                            });
                            self.scanner.addListener("scan", function (content, image) {
                                $("#code_murid").val(content);
                                document.getElementById("myForm").submit();
                            });
                            return Instascan.Camera.getCameras()
                            .then(function (cameras) {
                                self.cameras = cameras;
                                if (cameras.length > 0) {
                                    if (cameras[0]) {
                                        self.activeCameraId = cameras[0].id;
                                        return self.scanner.start(cameras[0]);
                                    } else {
                                        self.activeCameraId = cameras[0].id;
                                        return self.scanner.start(cameras[0]);
                                    }
                                } else {
                                    return console.error("No cameras found.");
                                }
                            })
                            .catch(function (e) {
                                return console.error(e);
                            });
                        },
                        methods: {
                            formatName: function (name) {
                                return name || "(unknown)";
                            },
                            selectCamera: function (camera) {
                                this.activeCameraId = camera.id;
                                return this.scanner.start(camera);
                            },
                        },
                    });
                }.call(this);

                $('#code_guru').attr('disabled',true);
                $('#code_murid').attr('disabled',false);
                $('#code_ortu').attr('disabled',true);
                
                document.getElementById("default").style.display = 'none';
                document.getElementById("guruNip").style.display = 'none';
                document.getElementById("muridNisn").style.display = 'block';
                document.getElementById("ortuNisn").style.display = 'none';

            } else if (st == "3") {
                var o = function () {
                    var app;
                    var route = "Shopping/getPro/";

                    app = new Vue({
                        el: "#app",
                        data: {
                            scanner: null,
                            activeCameraId: null,
                            cameras: [],
                            scans: [],
                        },
                        mounted: function () {
                            var self;
                            self = this;
                            self.scanner = new Instascan.Scanner({
                                video: document.getElementById("preview_ortu"),
                                scanPeriod: 3,
                                mirror: true,
                            });
                            self.scanner.addListener("scan", function (content, image) {
                                $("#code_ortu").val(content);
                                document.getElementById("myForm").submit();
                            });
                            return Instascan.Camera.getCameras()
                            .then(function (cameras) {
                                self.cameras = cameras;
                                if (cameras.length > 0) {
                                    if (cameras[0]) {
                                        self.activeCameraId = cameras[0].id;
                                        return self.scanner.start(cameras[0]);
                                    } else {
                                        self.activeCameraId = cameras[1].id;
                                        return self.scanner.start(cameras[1]);
                                    }
                                } else {
                                    return console.error("No cameras found.");
                                }
                            })
                            .catch(function (e) {
                                return console.error(e);
                            });
                        },
                        methods: {
                            formatName: function (name) {
                                return name || "(unknown)";
                            },
                            selectCamera: function (camera) {
                                this.activeCameraId = camera.id;
                                return this.scanner.start(camera);
                            },
                        },
                    });
                }.call(this);

                $('#code_guru').attr('disabled',true);
                $('#code_murid').attr('disabled',true);
                $('#code_ortu').attr('disabled',false);
                
                document.getElementById("default").style.display = 'none';
                document.getElementById("guruNip").style.display = 'none';
                document.getElementById("muridNisn").style.display = 'none';
                document.getElementById("ortuNisn").style.display = 'block';
            }
        }

    </script>

    <script type="text/javascript" src="<?= base_url('assets/templateuser/js/jquery-3.4.1.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/templateuser/js/jquery-3.4.1.min.js') ?>"></script>


    <script>
        window.setTimeout(function () {
            $(".alert").fadeTo(100, 0).slideUp(100, function () {
                $(this).remove();
            });
        }, 2000);
    </script>
    <script>
        window.setTimeout(function () {
            $(".alert").fadeTo(100, 0).slideUp(100, function () {
                $(this).remove();
            });
        }, 2000);
    </script>

</body>
</html>