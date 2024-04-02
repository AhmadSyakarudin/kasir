<?php
session_start();

// Pastikan session kasir dan asep ada dan berisi data
if (!isset($_SESSION['kasir']) || !isset($_SESSION['asep']) || empty($_SESSION['kasir']) || empty($_SESSION['asep'])) {
    echo "Terjadi kesalahan. Silahkan kembali ke halaman awal.";
    exit;
}

$kembalian = $_SESSION['asep']['kembalian'];
$uang = $_SESSION['asep']['uang'];
$total = $_SESSION['asep']['total'];

// Menampilkan struk
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Belanja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            margin: 0;
            padding: 20px;
    }
        .struk {
            border: 1px solid #ddd;
            padding: 20px;
    }
        .struk h1 {
            margin-top: 0;
            margin-bottom: 10px;
    }
        .struk p {
            margin-bottom: 5px;
    }
</style>
</head>
<body>
    <div class="struk">
        <h1>Struk Belanja</h1>
        <hr>
    <?php
        foreach ($_SESSION['kasir'] as $item) {
            echo "<p>" . $item['namaBarang'] . " - " . $item['jumlahBarang'] . " x Rp " . number_format($item['hargaBarang'], ) . "</p>";
    }
    ?>
        <hr>
        <p>Total: Rp <?php echo number_format($total, ); ?></p>
        <p>Uang Bayar: Rp <?php echo number_format($uang, ); ?></p>
        <p>Kembalian: Rp <?php echo number_format($kembalian, ); ?></p>
    </div>
    <button type="submit" name="kembali" class="btn btn-primary "><a href="reset.php" class="text-white" style="text-decoration: none;">Kembali</a></button>
</body>
</html>
