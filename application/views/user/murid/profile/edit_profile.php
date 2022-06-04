 mt-5<!-- Container -->
<main class="container px-8 mx-auto">
	<header class="flex mt-5 justify-items-start">
		<a href="<?=base_url('murid/profile');?>"
			class="p-1 transition duration-100 border-2 border-transparent rounded-primary focus:border-secondary-300">
			<svg class="w-6 stroke-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
				xmlns="http://www.w3.org/2000/svg">
				<path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2}
					d="M10 19l-7-7m0 0l7-7m-7 7h18" />
			</svg>
		</a>
	</header>

		<div class="pt-8 mt-4 mb-3">
            <h1 class="text-5xl font-semibold text-center">Edit Profile</h1>
        </div>

			<form action="<?=base_url('murid/edit_profile/') . $murid['id_murid'];?>" method="post" enctype="multipart/form-data" autocomplete="off">

				<!-- Murid  -->
				<input type="hidden" name="id_murid" value="<?=$edit_murid['id_murid'];?>">
				<input type="hidden" name="kelas_murid" value="<?=$edit_murid['kelas_murid'];?>">
				<input type="hidden" name="email_murid" value="<?=$edit_murid['email_murid'];?>">
				<input type="hidden" name="gender_murid" value="<?=$edit_murid['gender_murid'];?>">
				<input type="hidden" name="jurusan_murid" value="<?=$edit_murid['jurusan_murid'];?>">
				<input type="hidden" name="nis_murid" value="<?=$edit_murid['nis_murid'];?>">
				<input type="hidden" name="nisn_murid" value="<?=$edit_murid['nisn_murid'];?>">
				<input type="hidden" name="tanggal_lahir_murid" value="<?=$edit_murid['tanggal_lahir_murid'];?>">
				<input type="hidden" name="tempat_lahir_murid" value="<?=$edit_murid['tempat_lahir_murid'];?>">
				<input type="hidden" name="dibuat_murid" value="<?=$edit_murid['dibuat_murid'];?>">
				<!-- Alamat -->
				<input type="hidden" name="id_alamat" value="<?=$edit_murid['id_alamat'];?>">
				<!-- Pengguna -->
				<input type="hidden" name="id_auth" value="<?=$murid['id_auth'];?>">
				<input type="hidden" name="old_foto_pengguna" value="<?=$murid['foto_pengguna'];?>">
				<input type="hidden" name="tanggal_dibuat" value="<?=$murid['tanggal_dibuat'];?>">

				<center>
					<div class="avatar avatar-lg mt-5" id="imgTampil"></div>
					<div class="avatar avatar-lg mb-5 mt-5" id="imagePreview" style="display:none;"></div>

					<input style="display:none;" type="file" id="file" name="foto_pengguna" onchange="return fileValidation();" onclick="fileType();">

					<div>
						<label for="file" style="cursor:pointer;">
							<h5><span class="badge badge-warning ml-1">Edit Photo</span></h5>
						</label>
					</div>

				</center>
				<div class="mb-5 mt-5" x-model="field.txt1">
					<label class="font-semibold">Nama Lengkap</label>
					
					<input type="text" readonly
						class="w-full resize-none p-3 text-sm font-medium bg-transparent border-2 appearance-none placeholder-secondary-300 border-secondary-300 focus:outline-none focus:bg-gray-200 rounded-primary"
						type="text" rows="1" name="nama_murid" id="" placeholder="Nama Lengkap" value="<?=$edit_murid['nama_murid'];?>">
				</div>
			    <?=form_error('nama_murid', '<small class="text-danger">', '</small>');?>
				<div class="mb-5" x-model="field.txt1">
					<label class="font-semibold">Jenis Kelamin</label>

					<input type="text" disabled
						class="w-full resize-none p-3 text-sm font-medium bg-transparent border-2 appearance-none placeholder-secondary-300 border-secondary-300 focus:outline-none focus:bg-gray-200 rounded-primary"
						type="text" rows="1" name="gender_murid" id="" placeholder="Gender Murid"  value="<?=$edit_murid['gender_murid'];?>">
				</div>
				<div class="mb-5" x-model="field.txt1">
					<label class="font-semibold">E-Mail</label>
					<input type="text" disabled
						class="w-full resize-none p-3 text-sm font-medium bg-transparent border-2 appearance-none placeholder-secondary-300 border-secondary-300 focus:outline-none focus:bg-gray-200 rounded-primary"
						type="text" rows="1" name="email_murid" id="" placeholder="E-Mail"  value="<?=$edit_murid['email_murid'];?>">
				</div>
				<div class="mb-5" x-model="field.txt1">
					<label class="font-semibold">Kelas - Jurusan</label>

					<input type="text"
						class="w-full resize-none p-3 text-sm font-medium bg-transparent border-2 appearance-none placeholder-secondary-300 border-secondary-300 focus:outline-none focus:bg-gray-200 rounded-primary"
						type="text" rows="1" name="kelas_murid" id="" placeholder="E-Mail"  value="<?=$edit_murid['kelas_murid'];?> - <?=$edit_murid['jurusan_murid']?>" disabled>
				</div>
				<div class="mb-5" x-model="field.txt1">
					<label class="font-semibold">Nomor Induk Siswa</label>

					<input type="text"
						class="w-full resize-none p-3 text-sm font-medium bg-transparent border-2 appearance-none placeholder-secondary-300 border-secondary-300 focus:outline-none focus:bg-gray-200 rounded-primary"
						type="text" rows="1" name="nis_murid" id="" placeholder="NIS"  value="<?=$edit_murid['nis_murid'];?>" disabled>
				</div>
				<div class="mb-5" x-model="field.txt1">
					<label class="font-semibold">Nomor Induk Siswa Nasional</label>

					<input type="text"
						class="w-full resize-none p-3 text-sm font-medium bg-transparent border-2 appearance-none placeholder-secondary-300 border-secondary-300 focus:outline-none focus:bg-gray-200 rounded-primary"
						type="text" rows="1" name="nisn_murid" id="" placeholder="NISN"  value="<?=$edit_murid['nisn_murid'];?>" disabled>
				</div>
				<div class="mb-5" x-model="field.txt1">
					<label class="font-semibold">Tempat Lahir</label>

					<input type="text"
						class="w-full resize-none p-3 text-sm font-medium bg-transparent border-2 appearance-none placeholder-secondary-300 border-secondary-300 focus:outline-none focus:bg-gray-200 rounded-primary"
				 rows="1" name="tempat_lahir_murid" id="" placeholder="Tempat Lahir"  value="<?=$edit_murid['tempat_lahir_murid'];?>" disabled>
				</div>
				<div class="mb-5" x-model="field.txt1">
					<label class="font-semibold">Tanggal Lahir</label>

					<input type="text"
						class="w-full resize-none p-3 text-sm font-medium bg-transparent border-2 appearance-none placeholder-secondary-300 border-secondary-300 focus:outline-none focus:bg-gray-200 rounded-primary"
						type="text" rows="1" name="tanggal_lahir_murid" id="" placeholder="Tanggal Lahir"  value="<?=$edit_murid['tanggal_lahir_murid'];?>" disabled>
				</div>
				<div class="mb-5" x-model="field.txt1">
					<label class="font-semibold">Nomor Telepon</label>

					<input type="text"
						class="w-full resize-none p-3 text-sm font-medium bg-transparent border-2 appearance-none placeholder-secondary-300 border-secondary-300 focus:outline-none focus:bg-gray-200 rounded-primary"
						type="text" rows="1" name="telepon_murid" id="" placeholder="Tanggal Lahir"   maxlength="13" value="<?=$edit_murid['telepon_murid'];?>" onkeypress="return hanyaAngka(event)">
				</div>
				<div class="mb-5" x-model="field.txt1">
					<label class="font-semibold">Nama Jalan / Kampung / Blok</label>

					<input type="text" readonly
						class="w-full resize-none p-3 text-sm font-medium bg-transparent border-2 appearance-none placeholder-secondary-300 border-secondary-300 focus:outline-none focus:bg-gray-200 rounded-primary"
						type="text" rows="1" name="alamat" id="" placeholder="Alamat" value="<?=$edit_murid['alamat'];?>">
				</div>

				<!-- Alamat -->
				<div class="mb-5" x-model="field.txt1">
					<label class="font-semibold">Kecamatan</label>

					<input type="text" readonly
						class="w-full resize-none p-3 text-sm font-medium bg-transparent border-2 appearance-none placeholder-secondary-300 border-secondary-300 focus:outline-none focus:bg-gray-200 rounded-primary"
						type="text" rows="1" name="kecamatan" id="" placeholder="Kecamatan" value="<?=$edit_murid['kecamatan'];?>">
				</div>
				<div class="mb-5" x-model="field.txt1">
					<label class="font-semibold">Kelurahan</label>

					<input type="text" readonly
						class="w-full resize-none p-3 text-sm font-medium bg-transparent border-2 appearance-none placeholder-secondary-300 border-secondary-300 focus:outline-none focus:bg-gray-200 rounded-primary"
						type="text" rows="1" name="kelurahan" id="" placeholder="Kelurahan" value="<?=$edit_murid['kelurahan'];?>">
				</div>
				<div class="mb-5" x-model="field.txt1">
					<label class="font-semibold">Kota</label>

					<input type="text" readonly
						class="w-full resize-none p-3 text-sm font-medium bg-transparent border-2 appearance-none placeholder-secondary-300 border-secondary-300 focus:outline-none focus:bg-gray-200 rounded-primary"
						type="text" rows="1" name="kota" id="" placeholder="Kota" value="<?=$edit_murid['kota'];?>">
				</div>

				<div class="mb-5" x-model="field.txt1">
					<label class="font-semibold">Provinsi</label>

					<input type="text"
						class="w-full resize-none p-3 text-sm font-medium bg-transparent border-2 appearance-none placeholder-secondary-300 border-secondary-300 focus:outline-none focus:bg-gray-200 rounded-primary"
						type="text" rows="1" name="provinsi" id="" placeholder="Provinsi" value="<?=$edit_murid['provinsi'];?>">
				</div>
				<div class="mb-5" x-model="field.txt1">
					<label class="font-semibold">Kode Pos</label>

					<input type="text" readonly
						class="w-full resize-none p-3 text-sm font-medium bg-transparent border-2 appearance-none placeholder-secondary-300 border-secondary-300 focus:outline-none focus:bg-gray-200 rounded-primary"
						type="text" rows="1" name="kode_pos" id="" placeholder="Kode Pos" value="<?=$edit_murid['kode_pos'];?>">
				</div>
				    <div class="flex justify-center mt-10 text-white">
            <button type="submit" class="px-40 py-3 font-semibold text-center border-2 mb-10 border-b-8 focus:bg-primary-200 rounded-primary bg-primary-300 border-secondary-300">Edit</button>

        </div>
				
			</form>
		</div>

	</div>
</div>
</main>


	<script type="text/javascript">
		var url = "<?=base_url('assets/img/foto_pengguna/') . $murid['foto_pengguna'];?>";
		document.getElementById('imgTampil').innerHTML = '<img class="w-32 p-1 border rounded-full border-secondary-300" src="'+ url +'"/>';

		// Menampilkan Gambar Setelah Memilih //
		function fileType(){
			document.getElementById('imgTampil').style.display='none';
			document.getElementById('imagePreview').style.display='block';
		}

		function fileValidation(){
			var fileInput = document.getElementById('file');
			var filePath = fileInput.value;
			var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
			if(!allowedExtensions.exec(filePath)){
				alert('Something Wrong!');
				fileInput.value = '';
				return false;
			}else{
				if (fileInput.files && fileInput.files[0]) {
					var reader = new FileReader();
					reader.onload = function(e) {
						document.getElementById('imagePreview').innerHTML = '<img class="w-32 p-1 border rounded-full border-secondary-300" src="'+e.target.result+'"/>';
					};
					reader.readAsDataURL(fileInput.files[0]);
				}
			}

		}

	</script>