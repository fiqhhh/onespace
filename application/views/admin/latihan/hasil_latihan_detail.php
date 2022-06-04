<!-- Main Content -->
<div class="hk-pg-wrapper">
	<nav class="hk-breadcrumb" aria-label="breadcrumb">
		<ol class="breadcrumb breadcrumb-light bg-transparent mb-1">
			<li class="breadcrumb-item"><i data-feather='bar-chart-2' class='icons-br-size'></i> <a href="<?= base_url('admin/'); ?>">Dashboard</a></li>
			<li class="breadcrumb-item"><i data-feather='check-circle' class='icons-br-size'></i> <a href="<?= base_url('admin/hasil_latihan'); ?>">Hasil Latihan</a></li>
			<li class="breadcrumb-item active" aria-current="page"><i data-feather='search' class='icons-br-size'></i> <?= $latihan_row['nama_latihan']; ?></li>
		</ol>
	</nav>
	<!-- Container -->
	<div class="container mt-10">
		<div class="row">
			<div class="col-xl-12">
				<section class="hk-sec-wrapper">
					<h5 class="d-flex align-items-end hk-sec-title mb-0"><i data-feather="search" class="mr-1 icons-header-size"></i> Detail Hasil Latihan</h5>
					<hr>
					
					<div class="row mb-3">
						<div class="col-sm-12 mb-3">
							<a href="<?= base_url('admin/hasil_latihan'); ?>" class="btn btn-sm btn-secondary"><i data-feather="arrow-left" class="icons-size"></i> Kembali</a>
							<div class="pull-right">
								<a href="<?= base_url('admin/latihan'); ?>" class="btn btn-sm btn-pink"><i data-feather="printer" class="icons-size"></i> Print</a>
							</div>
						</div>
						<div class="col-sm-6">
							<table class="table w-100">
								<tr>
									<th class="font-weight-bold">Nama Latihan</th>
									<td><?= $latihan_row['nama_latihan']; ?></td>
								</tr>
								<tr>
									<th class="font-weight-bold">Tipe Latihan</th>
									<?php if($latihan_row['tipe_latihan'] == "1"){ ?>
										<td>Pilihan Ganda</td>
									<?php }elseif($latihan_row['tipe_latihan'] == "2"){ ?>
										<td>Essay</td>
									<?php }elseif($latihan_row['tipe_latihan'] == "3"){ ?>
										<td>Pilihan Ganda & Essay</td>
									<?php } ?>
								</tr>
								<tr>
									<th class="font-weight-bold">Jumlah Soal</th>
									<td><?= $jumlah_soal; ?> Soal</td>
								</tr>
								<tr>
									<th class="font-weight-bold">Waktu</th>
									<?php if(empty($latihan_row['waktu_latihan'])){ ?>
										<td>Tidak diwaktui</td>
									<?php }else{ ?>
										<td><?= $latihan_row['waktu_latihan']; ?> Menit</td>
									<?php } ?>
								</tr>
								<!-- <tr>
									<th class="font-weight-bold">Tenggat Latihan</th>
									<?php if(empty($latihan_row['tenggat_latihan'])){ ?>
										<td>Tidak dibatasi</td>
									<?php }else{ ?>
										<td><?= $latihan_row['tenggat_latihan']; ?></td>
									<?php } ?>
								</tr> -->
							</table>
						</div>
						<div class="col-sm-6">
							<table class="table w-100">
								<tr>
									<th class="font-weight-bold">Ruang Kelas</th>
									<td><?= $latihan_row['nama_kelas']; ?></td>
								</tr>
								<tr>
									<th class="font-weight-bold">Mata Pelajaran</th>
									<td><?= $latihan_row['nama_mapel']; ?></td>
								</tr>
								<tr>
									<th class="font-weight-bold">Guru</th>
									<td><?= $latihan_row['nama_guru'] ?>, <?= $latihan_row['gelar_guru']; ?></td>
								</tr>
								<tr>
									<th class="font-weight-bold">Point Latihan</th>
									<td><?= number_format($latihan_row['point_latihan'] ,2,".","."); ?></td>
								</tr>
								<!-- <tr>
									<th class="font-weight-bold">Nilai Tertinggi</th>
									<td><?= number_format($latihan_row['point_latihan'] ,2,".","."); ?></td>
								</tr> -->
							</table>
						</div>
					</div>

					<div class="table-wrap">
						<table id="datable_3" class="table table-striped w-100 mb-30 ">
							<thead>
								<tr>
									<th class="">No</th>
									<th class="">Nama Murid</th>
									<th class="">Kelas - Jurusan</th>
									<th class="">Jumlah Benar</th>
									<th class="">Nilai</th>
									<th class="">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($latihan_result as $key){ ?>
									<?php $where_murid = $this->m_hasil_latihan->WhereMurid($key->id_murid, $latihan_row['id_latihan'])->result(); ?>
								<?php } ?>

								<?php $num=1; foreach($where_murid as $key){ ?>
									<?php $nilai_murid = $this->m_hasil_latihan->NilaiMurid($key->id_murid, $latihan_row['id_latihan'])->result(); ?>
									<tr>
										<td><?= $num++; ?></td>
										<td><?= $key->nama_murid; ?></td>
										<td><?= $key->kelas_murid; ?> - <?= $key->jurusan_murid; ?></td>
										<td>4</td>
										<?php foreach($nilai_murid as $row){ ?>
											<td><?= $row->point_hasil; ?></td>  
										<?php } ?>
										<td>
											<a href="<?= base_url('admin/hasil_latihan_murid/'.$key->id_latihan."/".$key->id_murid); ?>" class="btn btn-xs btn-secondary"><i class="fa fa-eye"></i> Lihat Jawaban</a>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</section>
			</div>
		</div>
	</div>