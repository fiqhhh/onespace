<main class="container px-8 mx-auto">
    
    <header class="flex mt-5 justify-items-start">
        <a href="<?= base_url('murid/'); ?>" class="p-1 transition duration-100 border-2 border-transparent rounded-primary focus:border-secondary-300">
            <svg class="w-6 stroke-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
        </a>
    </header>

    <section class="mt-6">
        <form action="<?= base_url('murid/absen_murid_masuk_proses'); ?>" id="myForm" method="post" autocomplete="off">
            <span class="text-lg font-bold">Pindai QR Code</span>

            <input type="hidden" name="id_murid" value="<?= $murid['id_murid']; ?>">
            <input type="hidden" name="lokasi_berada" id="tampilkan">

            <!-- Murid -->
            <div> 
                <div class="w-full h-auto p-4 mt-2 border-2 border-b-8 border-secondary-300 rounded-primary">
                    <video id="preview_murid" class="flex items-center w-full h-64 place-content-center bg-secondary-300 rounded-primary"></video>
                    <input class="form-control" id="code_murid" type="hidden" name="nisn_murid">
                </div>
            </div>

        </form>
    </section>
</main>

<script src="<?= base_url('assets/loginQrcode/js/jquery-3.4.1.min.js'); ?>"></script>
<script src="<?= base_url('assets/loginQrcode/scanner/js/app.js'); ?>"></script>
<script src="<?= base_url('assets/loginQrcode/scanner/vendor/vue/vue.min.js'); ?>"></script>
<script src="<?= base_url('assets/loginQrcode/scanner/vendor/modernizr/modernizr.js'); ?>"></script>
<script src="<?= base_url('assets/loginQrcode/scanner/vendor/instascan/instascan.min.js'); ?>"></script>

<script type="text/javascript">
    const view = document.getElementById('tampilkan');
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        view.innerHTML = "Yah browsernya ngga support Geolocation bro!";
    }

    function showPosition(position) {
        console.log(position.coords.latitude + "+" + position.coords.longitude);
        view.innerHTML = position.coords.latitude + '+' + position.coords.longitude;
        view.setAttribute( "value", position.coords.latitude + "+" + position.coords.longitude );
    }

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
                        if (cameras[1]) {
                            self.activeCameraId = cameras[1].id;
                            return self.scanner.start(cameras[1]);
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

    $('#code_murid').attr('disabled',false);

</script>
