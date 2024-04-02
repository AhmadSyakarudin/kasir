<?php

session_start();

// Array multidimensi belum ada, buat dulu
if (!isset($_SESSION['kasir'])) {
    $_SESSION['kasir'] = array();
}

// Mendapatkan total harga barang
$totalHarga = 0;
foreach ($_SESSION['kasir'] as $item) {
  $totalHarga += $item['hargaBarang'] * $item['jumlahBarang'];
}

// Mendapatkan uang bayar
$uangBayar = @$_POST['uangBayar'];

// Menghitung kembalian
$kembalian = $uangBayar - $totalHarga;

// Menampilkan hasil
if (isset($_POST['kirim'])) {
  // Validasi input
    if (!isset($uangBayar) || empty($uangBayar)) {
        // echo "<div class='alert alert-danger'>Uang bayar tidak boleh kosong!</div>";
    } elseif ($uangBayar < $totalHarga) {
        echo "<div class='alert alert-danger'>Uang bayar tidak cukup!</div>";
    } else {
    // Simpan data ke session
        $_SESSION['asep'] = [
            'kembalian' => $kembalian,
            'uang' => $uangBayar,
            'total' => $totalHarga
    ];

    // Redirect ke halaman struk
    header("Location: struk.php");
    exit;
}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Disini</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <h1>Pembayaran Disini</h1>
</head>

<body style="width: 512px;">
    <form method="POST" action="">
        <div class="form-floating mb-3">
            <input type="number" name="uangBayar" class="form-control" id="masukkanUang">
            <label for="masukkanUang" class="form-label">Masukkan Uang</label>
        </div>
    <button type="submit" name="kirim" class="btn btn-primary">Bayar</button>
    </form>

</body>

</html>
