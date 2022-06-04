<?php 

class Flasher extends CI_Model {

	public static function setFlash($pesan,$aksi,$tipe){
		$_SESSION['flash'] = [
			'pesan' => $pesan,
			'aksi' => $aksi,
			'tipe' => $tipe
		];
	}

	public static function flash(){
		if(isset($_SESSION['flash'])){
			echo '<div class="alert alert-inv alert-inv-'.$_SESSION['flash']['tipe'].' alert-wth-icon alert-dismissible fade show" role="alert">
			<span class="alert-icon-wrap"><i class="zmdi zmdi-'.$_SESSION['flash']['aksi'].'"></i></span>'.$_SESSION['flash']['pesan'].'
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			</div>';

			unset($_SESSION['flash']);
		}
	}
}