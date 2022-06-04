<!DOCTYPE html>
<html>
<head>
	<title><?= $title; ?></title>
</head>
<body>
	<h1>Selamat Datang, <?= $murid['nama_murid']; ?>.</h1>
	<h3>Mohon maaf <?= $murid['nama_murid']; ?> dikarnakan masih tahap pembangunan. Diharapkan keluar <a href="<?= base_url('murid/logout'); ?>">Klik disini!</a></h3>

</body>
</html>