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
                    echo '<table class="table table-bordered table-striped text-center mt-2">
                        <thead>
                            <tr class="bg-dark text-white">
                                <th scope="col" id="hop1">Ürün Adı</th>
                                <th scope="col" id="hop2">Adet</th>
                                <th scope="col" id="hop3">Tutar</th>
                                <th scope="col" id="hop4">İşlem</th>
                            </tr>
                        </thead>
                        <tbody>';
                    $adet = 0;
                    $sontutar = 0;
                    while($ontable=$k->FETCH_ASSOC()):
                        $tutar = $ontable["adet"] * $ontable["urunfiyat"];
                        $adet += $ontable["adet"];
                        $sontutar += $tutar;
                        $masaid = $ontable["masaid"];
        
                        echo '<tr>
                            <td class="mx-auto text-center p-4">'.$ontable["urunad"].'</td>
                            <td class="mx-auto text-center p-4">'.$ontable["adet"].'</td>
                            <td class="mx-auto text-center p-4">'.number_format($tutar,2,'.',',').'</td>
                            <td id="yakala"><a class="btn btn-danger mt-2 text-white" sectionId="'.$ontable["urunid"].'" sectionId2="'.$masaid.'" >SİL</a></td>
                        </tr>';
        
                    endwhile;
        
                    echo '</tbody></table>
                    <div class = "row">
                        <div class = "col-md-12">
                            <form id = "hesapalform">
                                <input type="hidden" name="masaid" value="'.$masaid.'"/>
                                <button type="button" id="hesapalbtn" value="HESAP AL" style="font-weight:bold; height:40px;" class="btn btn-dark btn-block mt-2">HESAP AL</button>
                            </form>
                        </div>
                    </div>';
                endif;
                break;
        endswitch;

?>
</body>
</html>
