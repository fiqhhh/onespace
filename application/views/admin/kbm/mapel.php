<!-- Main Content -->
<div class="hk-pg-wrapper">

    <nav class="hk-breadcrumb" aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-light bg-transparent mb-1">
            <li class="breadcrumb-item"><i data-feather='bar-chart-2' class='icons-br-size'></i> <a href="<?= base_url('admin/'); ?>">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><i data-feather='clipboard' class='icons-br-size'></i> Mata Pelajaran</li>
        </ol>
    </nav>

    <!-- Modal Forms -->
    <div class="modal fade" id="modalform" tabindex="-1" role="dialog" aria-labelledby="modalform" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalformtitle"></h5>
                    <button type="button" class="close"  data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="form" autocomplete="off">
                        <div class="form-group">
                            <label>Nama Mata Pelajaran</label>
                            <input type="hidden" name="id_mapel">
                            <input type="text" name="nama_mapel" class="form-control" placeholder="Masukan Nama Mata Pelajaran" value="<?= set_value('nama_mapel'); ?>">
                            <?= form_error('nama_mapel','<small class="text-danger">','</small>'); ?>
                        </div>

                        <hr class="mb-3">     
                        <div class="float-right mb-1">
                            <button type="submit" class="btn btn-secondary" data-dismiss="modal" >Batal</button>
                            <button type="submit" id="modalformsubmit" class="btn btn-primary"></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Container -->
    <div class="container mt-10">
        <div class="row">
            <div class="col-xl-12">
                <section class="hk-sec-wrapper">
                    <h5 class="d-flex align-items-end hk-sec-title mb-1"><i data-feather="clipboard" class="mr-1 icons-header-size"></i> Mata Pelajaran</h5>
                    <p class="mb-15">Data Mata Pelajaran SMK Negeri 1 Depok</p>

                    <?= Flasher::flash(); ?>

                    <div class="row mb-5">
                        <div class="col-sm-9">
                            <button class="btn btn-primary btn-wth-icon icon-right mb-15" data-toggle="modal" data-target="#modalform" onclick="tambah();">
                                <span class="btn-text">Tambah Data</span> 
                                <span class="icon-label">
                                    <span class="feather-icon"><i data-feather="plus-circle"></i></span>
                                </span>
                            </button>
                        </div>
                        <div class="col-sm-3">
                            <form action="#" method="POST">
                                <div class="input-group">
                                    <div class="select2-container" style="width:80% !important;">
                                        <select class="select2" name="kelas">
                                            <option selected="" disabled="">Kelas</option>
                                        </select>
                                    </div>
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm">
                            <div class="table-wrap">
                                <table id="datable_3" class="table table-striped w-100 mb-30 ">
                                    <thead>
                                        <tr>
                                            <th class="">No</th>
                                            <th class="">Mata Pelajaran</th>
                                            <th class="">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=1; foreach($mapel as $key){ ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $key->nama_mapel; ?></td>

                                                <td>
                                                    <a onclick="edit(<?= $key->id_mapel; ?>);" class="btn btn-xs btn-icon btn-info text-white" data-toggle="modal" data-target="#modalform"><span class="btn-icon-wrap"><span class="feather-icon"><i data-feather="edit"></i></span></span></a>
                                                    <a href="<?= base_url('mapel/delete_mapel/' . $key->id_mapel); ?>" onclick="return confirm('Yakin Ingin Menghapus Data?')" class="btn btn-xs btn-icon btn-danger"><span class="btn-icon-wrap"><span class="feather-icon"><i data-feather="trash-2"></i></span></span></a>
                                                </td>
                                            </tr>   
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- /Container -->


    <!-- Ajax -->
    <script type="text/javascript">

        function tambah(){
            $('#form')[0].reset();
            $('#modalformtitle').html('Tambah Mata Pelajaran'); 
            $('#modalformsubmit').html('Tambah Mata Pelajaran');  
            document.getElementById('form').action = "<?= base_url('admin/mapel'); ?>";
        }

        function edit(id_mapel){
            $('#modalformtitle').html('Edit Mata Pelajaran'); 
            $('#modalformsubmit').html('Edit Mata Pelajaran'); 
            document.getElementById('form').action = "<?= base_url('mapel/update_mapel'); ?>";
            $.ajax({
                url : "<?= base_url('mapel/edit_mapel/'); ?>" + id_mapel ,
                type: "GET",
                dataType : "JSON",
                success:function(data){
                    $('[name="id_mapel"]').val(data.id_mapel);
                    $('[name="nama_mapel"]').val(data.nama_mapel);
                },
                error:function(jqXHR,textStatus,errorThrown){
                    alert('Gagal Mengambil Data, Silahkan Refresh Kembali');
                }
            })
        }

    </script>


