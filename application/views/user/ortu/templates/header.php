<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link rel="icon" type="text/css" href="<?= base_url('assets/img/icon/w-icons.png') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/templateuser/css/app.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/multiple/file-upload-with-preview.min.css'); ?>">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.min.js" defer></script>
</head>

<?php
function time_since($original)
{
    $chunks = array(
        array(60 * 60 * 24 * 365, 'Tahun'),
        array(60 * 60 * 24 * 30, 'Bulan'),
        array(60 * 60 * 24 * 7, 'Minggu'),
        array(60 * 60 * 24, 'Hari'),
        array(60 * 60, 'Jam'),
        array(60, 'Menit'),
    );
    $today = time();
    $since = $today - $original;

    if ($since > 604800) {
        $print = date("j M, Y", $original);
            // $print = date("j M, Y H:i A", $original);
        if ($since > 31536000) {
            $print .= ", " . date("Y", $original);
        }
        return $print;
    }
    for ($i = 0, $j = count($chunks); $i < $j; $i++) {
        $seconds = $chunks[$i][0];
        $name = $chunks[$i][1];

        if (($count = floor($since / $seconds)) != 0)
            break;
    }
    $print = ($count == 1) ? '1 ' . $name : "$count {$name}";
    if ($print == 0) {
        return "Baru Saja";
    } elseif ($print == "1 Hari") {
        return "Kemarin";
    } else {
        return $print . ' yang lalu';
    }
}
?>
<body class="font-sans antialiased bg-gray-100 text-secondary-300">

