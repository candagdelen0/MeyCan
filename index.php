<?php
include("fonksiyon.php");
$sistem = new Sistem;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MeyCan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="Dosyalar/jquery-3.6.2.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <style>
        a {
            text-decoration: none;
        }
    </style>

</head>
<body>
    <div class="container-fluid">
        <div class="row text-light bg-dark">
            <div class="col-md-3 text-center border-end"><i class="fa-sharp fa-solid fa-cart-shopping text-light"></i> Toplam Sipariş : 10</div>
            <div class="col-md-3 text-center border-end" ><i class="fa-sharp fa-solid fa-chart-column text-light"></i> Doluluk Oranı : 10</div>
            <div class="col-md-3 text-center border-end"><i class="fa-sharp fa-solid fa-chart-layer-group text-light"></i>Toplam Masa : 10</a></div>
            <div class="col-md-3 text-center border-end">Tarih : <?php echo date("d.m.Y"); ?></a></div>
        </div>
        <div class="row">
            <?php $sistem->masagetir($db); ?>
        </div>
    </div>
</body>
</html>

