<!-- Main Content -->
<div class="hk-pg-wrapper">

	<nav class="hk-breadcrumb" aria-label="breadcrumb">
		<ol class="breadcrumb breadcrumb-light bg-transparent mb-1">
			<li class="breadcrumb-item"><i data-feather='bar-chart-2' class='icons-br-size'></i> <a href="<?= base_url('admin/'); ?>">Dashboard</a></li>
			<li class="breadcrumb-item active" aria-current="page"><i data-feather='home' class='icons-br-size'></i> Jurusan Kelas</li>
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
							<label>Nama Jurusan</label>
							<input type="hidden" name="id_jurusan">
							<input type="text" name="nama_jurusan" class="form-control" placeholder="Masukan Nama Jurusan" value="<?= set_value('nama_jurusan'); ?>">
							<?= form_error('id_murid','<small class="text-danger">','</small>'); ?>
						</div>
						<hr class="mb-3">     
						<div class="float-right mb-1">
							<button type="submit" class="btn btn-secondary" data-dismiss="modal">Batal</button>
							<button type="submit" class="btn btn-primary"><i data-feather="save" class="mr-1 icons-size"></i>Simpan</button>
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
					<h5 class="d-flex align-items-end hk-sec-title mb-1"><i data-feather="home" class="mr-1 icons-header-size"></i> Jurusan Kelas</h5>
					<p class="mb-15">Data Jurusan Kelas</p>

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
											<option selected="" disabled="">Jurusan</option>
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
											<th class="">Nama Jurusan</th>
											<th class="">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php $no=1; foreach($jurusan as $key){ ?>
											<tr>
												<td><?= $no++; ?></td>
												<td><?= $key->nama_jurusan; ?></td>
												<td>
													<a onclick="edit(<?= $key->id_jurusan; ?>);" class="btn btn-xs btn-icon btn-warning text-white" data-toggle="modal" data-target="#modalform"><span class="btn-icon-wrap"><span class="feather-icon"><i data-feather="edit"></i></span></span></a>
													<a href="<?= base_url('jurusan/delete_jurusan/' . $key->id_jurusan); ?>" onclick="return confirm('Yakin Ingin Menghapus Data?')" class="btn btn-xs btn-icon btn-danger"><span class="btn-icon-wrap"><span class="feather-icon"><i data-feather="trash-2"></i></span></span></a>
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
			$('#modalformtitle').html('Tambah Jurusan'); 
			document.getElementById('form').action = "<?= base_url('admin/jurusan') ?>";
		}

		function edit(id_jurusan){
			$('#modalformtitle').html('Edit Jurusan'); 
			document.getElementById('form').action = "<?= base_url('jurusan/update_jurusan') ?>";
			$.ajax({
				url : "<?= base_url('jurusan/edit_jurusan/') ?>" + id_jurusan ,
				type: "GET",
				dataType : "JSON",
				success:function(data){
					$('[name="id_jurusan"]').val(data.id_jurusan);
					$('[name="nama_jurusan"]').val(data.nama_jurusan);
				},
				error:function(jqXHR,textStatus,errorThrown){
					alert('Gagal Mengambil Data, Silahkan Refresh Kembali');
				}
			})
		}

	</script>


