<?php

session_start();

// Array multidimensi belum ada, buat dulu
if (!isset($_SESSION['kasir'])) {
    $_SESSION['kasir'] = array();
}

// Proses button hapus pada table tampil data
if (isset($_GET['hapus'])) {
    $index = $_GET['hapus'];
    unset($_SESSION['kasir'][$index]);
}

// Array ada, buat array data dari data yang dimasukkan
if (isset($_POST['kirim'])) {
  // Pastikan semua kolom terisi
    if (@$_POST['namaBarang'] && @$_POST['hargaBarang'] && @$_POST['jumlahBarang']) {

    // Temukan index barang yang sama
    $indexBarangSama = -1;
    foreach ($_SESSION['kasir'] as $key => $item) {
        if ($item['namaBarang'] === $_POST['namaBarang']) {
        $indexBarangSama = $key;
        break;
    }
    }

    // Jika barang sama ditemukan, tambahkan jumlahnya
    if ($indexBarangSama !== -1) {
        $_SESSION['kasir'][$indexBarangSama]['jumlahBarang'] += $_POST['jumlahBarang'];
    } else {
      // Jika barang tidak sama, tambahkan data baru
    $data = array(
        'namaBarang' => $_POST['namaBarang'],
        'hargaBarang' => $_POST['hargaBarang'],
        'jumlahBarang' => $_POST['jumlahBarang'],
    );
        array_push($_SESSION['kasir'], $data);
    }
}
}

// Hitung total
$total = 0;
foreach ($_SESSION['kasir'] as $item) {
  $total += $item['hargaBarang'] * $item['jumlahBarang'];
}

?>

<style>

    .main a {
        color:white;
        text-decoration: none;
    }
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

<div class="main d-flex flex-column justify-content-center align-items-center ">
        <div class="login-box p-5 shadow ">
        <h1 style="text-align:center">KASIR SEDERHANA</h1>

    <form method="POST" action="">

        <div class="form-floating mb-3">
            <input type="text" name="namaBarang" class="form-control" id="floatingInput">
            <label for="floatingInput">Nama Barang</label>
        </div>

        <div class="form-floating mb-3">
            <input type="number" name="hargaBarang" class="form-control" id="HargaBarang">
            <label for="HargaBarang" class="form-label">Harga Barang</label>
        </div>

        <div class="form-floating mb-3">
            <input type="number" name="jumlahBarang" class="form-control" id="JumlahBarang">
            <label for="JumlahBarang" class="form-label">Jumlah Barang</label>
        </div>    

        <button type="submit" name="kirim"class="btn btn-primary">Tambahkan</button>
        <button type="submit" name="reset"class="btn btn-danger"><a href="reset.php">Reset</a></button>

</form>
<table class="table mt-5">
    <thead>
    <tr>
        <th>Nama Barang</th>
        <th>Harga Barang</th>
        <th>Jumlah Barang</th>
        <th>Total</th>
        <th>Aksi</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($_SESSION['kasir'] as $index => $item): ?>
    <tr>
        <td><?php echo $item['namaBarang']; ?></td>
        <td>Rp. <?php echo $item['hargaBarang']; ?></td>
        <td><?php echo $item['jumlahBarang']; ?></td>
        <td><?php echo $item['hargaBarang'] * $item['jumlahBarang']; ?></td>
        <td>
        <a href="?hapus=<?php echo $index; ?>" class="btn btn-danger btn-sm">Hapus</a>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
    <tfoot>
    <tr>
        <th colspan="3">Total</th>
        <th>Rp. <?php echo number_format($total, ); ?></th>
        <th><button type="submit" name="kirim"class="btn btn-primary"><a href="bayar.php">Bayar</a></button></th>
    </tr>
    </tfoot>
</table>
<div>
    
</div>
</body>
</html>