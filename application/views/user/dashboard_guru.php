<!DOCTYPE html>
<html>
<head>
	<title><?= $title; ?></title>
</head>
<body>
	<h1>Selamat Datang, <?= $guru['nama_guru']; ?>, <?= $guru['gelar_guru']; ?>.</h1>
	<h3>Mohon maaf <?= $guru['nama_guru']; ?>, <?= $guru['gelar_guru']; ?> dikarnakan masih tahap pembangunan. Diharapkan keluar <a href="<?= base_url('guru/logout'); ?>">Klik disini!</a></h3>
</body>
</html>