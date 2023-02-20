<?php
include("fonksiyon.php");
ob_start();
session_start();
@$masaid = $_GET["masaid"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="Dosyalar/jquery-3.6.2.min.js"></script>
    <title>İşlemler</title>
</head>
<body>

<?php

    function benimsorgum($vt,$sorgu,$tercih) {
        $b=$vt->prepare($sorgu);
        $b->execute();
        if ($tercih==1):
            return $c=$b->get_result();  
        endif;
    }

    function uyari($mesaj,$renk) {
        echo '<div class="alert alert-'.$renk.' mt-4 text-center">'.$mesaj.'</div>';
    }

    $işlem = htmlspecialchars($_GET["islem"]);
        switch($işlem):
            case "masagoster":
                $id = htmlspecialchars($_GET["id"]);
                $k = benimsorgum($db, "SELECT * FROM siparisler WHERE masaid=$id",1);
                if($k->num_rows==0):
                    uyari("Henüz sipariş yok","danger");
                else:
                    $adet = 0;
                    $sontutar = 0;
                    while($ontable=$k->FETCH_ASSOC()):
                        $tutar = $ontable["adet"] * $ontable["urunfiyat"];
                        $adet += $ontable["adet"];
                        $sontutar += $tutar;
                        $masaid = $ontable["masaid"];
                    endwhile;
                endif;
                break;
        endswitch;

?>
</body>
</html>
