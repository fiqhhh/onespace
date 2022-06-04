<!-- Container -->
<main class="container px-8 mx-auto">
	<header class="flex mt-5 justify-items-start">
		<a href="<?=base_url('ortu/profile');?>"
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

			<form action="<?=base_url('ortu/edit_profile/') . $ortu['id_orang_tua'];?>" method="post" enctype="multipart/form-data" autocomplete="off">

				<!-- Murid  -->
				<input type="hidden" name="id_orang_tua" value="<?=$edit_ortu['id_orang_tua'];?>">
				<input type="hidden" name="id_murid" value="<?=$edit_ortu['id_murid'];?>">
				<input type="hidden" name="status_ortu" value="<?=$edit_ortu['status_ortu'];?>">
				<input type="hidden" name="dibuat_ortu" value="<?=$edit_ortu['dibuat_ortu'];?>">
				<!-- Pengguna -->
				<input type="hidden" name="id_auth" value="<?=$ortu['id_auth'];?>">
				<input type="hidden" name="old_foto_pengguna" value="<?=$ortu['foto_pengguna'];?>">
				<input type="hidden" name="tanggal_dibuat" value="<?=$ortu['tanggal_dibuat'];?>">

				<center>
					<div class="avatar avatar-lg mt-5" id="imgTampil"></div>
					<div class="avatar avatar-lg mb-5 mt-5" id="imagePreview" style="display:none;"></div>

					<input style="display:none;" class="mt-5" type="file" id="file" name="foto_pengguna" onchange="return fileValidation();" onclick="fileType();">

					<div>
						<label for="file" style="cursor:pointer;">
							<h5><span class="badge badge-warning ml-1">Edit Photo</span></h5>
						</label>
					</div>

				</center>
				<div class="mb-5 mt-5" x-model="field.txt1">
					<label class="font-semibold">Nama Lengkap</label>
					
					<input type="text"
						class="w-full resize-none p-3 text-sm font-medium bg-transparent border-2 appearance-none placeholder-secondary-300 border-secondary-300 focus:outline-none focus:bg-gray-200 rounded-primary"
						type="text" rows="1" name="nama_ortu" id="" placeholder="Nama Lengkap" value="<?=$edit_ortu['nama_ortu'];?>">
				</div>
			    <?=form_error('nama_ortu', '<small class="text-danger">', '</small>');?>

				<div class="mb-5" x-model="field.txt1">
					<label class="font-semibold">E-Mail</label>
					<input type="email"
						class="w-full resize-none p-3 text-sm font-medium bg-transparent border-2 appearance-none placeholder-secondary-300 border-secondary-300 focus:outline-none focus:bg-gray-200 rounded-primary"
						type="text" rows="1" name="email_ortu" id="" placeholder="E-Mail"  value="<?=$edit_ortu['email_ortu'];?>">
				</div>
				<div class="mb-5" x-model="field.txt1">
					<label class="font-semibold">Nomor Telepon</label>

					<input type="text"
						class="w-full resize-none p-3 text-sm font-medium bg-transparent border-2 appearance-none placeholder-secondary-300 border-secondary-300 focus:outline-none focus:bg-gray-200 rounded-primary"
						type="text" rows="1" name="telepon_ortu" maxlength="13" value="<?=$edit_ortu['telepon_ortu'];?>" onkeypress="return hanyaAngka(event)">
				</div>
				    <div class="flex justify-center mt-10 w-full text-white">
            <button type="submit" class="px-40 py-3 font-semibold text-center border-2 mb-10 border-b-8 focus:bg-primary-200 rounded-primary bg-primary-300 border-secondary-300">Edit</button>
        </div>
				
			</form>
		</div>

	</div>
</div>
</main>


	<script type="text/javascript">
		var url = "<?=base_url('assets/img/foto_pengguna/') . $ortu['foto_pengguna'];?>";
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