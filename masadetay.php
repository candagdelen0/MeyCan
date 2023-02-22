<?php
session_start();
include("fonksiyon.php");
$masam = new Sistem;
@$masaid=$_GET["masaid"];
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
    <link rel="stylesheet" href="Dosyalar/style.css">
    <title>Masa Bilgi</title>

    <script>
        $$(document).ready(function() {	
	        var id="<?php echo $masaid; ?>";	
	        $("#veri").load("islem.php?islem=masagoster&id="+id);
	        $('#btn').click(function() {		
		        $.ajax({			
			        type : "POST",
			        url :'islem.php?islem=ekle',
			        data :$('#formum').serialize(),			
			        success: function(donen_veri) {
			            $("#veri").load("islem.php?islem=masagoster&id="+id);
			            $('#formum').trigger("reset");	
			            $("#cevap").html(donen_veri).fadeOut(1400);	
				        window.location.reload();
			        },			
		        })		
	        })
            $('#urunler a').click(function(){		
	        var sectionId=$(this).attr('sectionId');
	        $("#sonuc").load("islemler.php?islem=urun&katid=" + sectionId);
	        })
        });
</script>
</head>
<body>
    <div class="container h-100">
        <?php
            if ($masaid != ""):
                $son = $masam->masaac($db,$masaid);
                $dizi=$son->FETCH_ASSOC();
        ?>
        <div class="row border border-dark m-1" id="div1" style="min-height:700px;">
            <div class="col-md-4 border-end border-dark">
                <div class="row">
                    <div class="col-md-12 border-bottom border-success bg-success text-white mx-auto p-4 text-center" id="a1">
                        <a href="index.php" class="btn btn-primary">Anasayfa</a><br>    
                        <?php echo $dizi["ad"]; ?>
                    </div>
                    <div class="col-md*12">
                        <div class="row">
                            <div class="col-md-12 mx-auto" id="veri"></div>                    
                            <div class="col-md-12" id="cevap"></div> 
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-8"> 
                <div class="row pt-2">
                    <form id="formum">
                        <div class="col-md-12" id="urunler">
                            <?php $masam->urungrubu($db); ?>
                        </div>     
                        <div class="col-md-12 text-center" id="sonuc">
                        </div>  
                        <div class="col-md-12" style="min-height:170px;">
                            <div class="row">
                                <div class="col-md-2 text-center border-end">
                                    <input type="hidden" name="masaid" value="<?php echo $dizi["id"]; ?>">
                                    <input type="button" id="btn" value="EKLE" class="btn mt-5 mb-1" style="background-color:#193d49; color:#58d0f8; font-size:30px; height:80px; min-width:100px;">
                                </div>
                                <div class="col-md-5 border-end text-center">
                                    <h2>Ürün Adedi</h2><hr>
                                    <?php
                                        for ($i=1; $i<=7; $i++):
                                            echo '<label class="btn m-2" style="background-color:#193d49; color:#58d0f8;">
                                            <input type="radio" name="adet" value=" '.$i.' "> '.$i.'</label>';
                                        endfor;
                                    ?>
                                </div>
                                <div class="col-md-5 text-center">
                                    <h2>İskonto</h2><hr>
                                    <label class="btn m-1" style="background-color:#193d49; color:#58d0f8;"><input name="iskonto" type="radio" value="5"> % 5</label>
                                    <label class="btn m-1" style="background-color:#193d49; color:#58d0f8;"><input name="iskonto" type="radio" value="10"> % 10</label>
                                    <label class="btn m-1" style="background-color:#193d49; color:#58d0f8;"><input name="iskonto" type="radio" value="15"> % 15</label>
                                    <label class="btn m-1" style="background-color:#193d49; color:#58d0f8;"><input name="iskonto" type="radio" value="20"> % 20</label>
                                    <label class="btn m-1" style="background-color:#193d49; color:#58d0f8;"><input name="iskonto" type="radio" value="25"> % 25</label>
                                </div>
                            </div>
                        </div>    
                    </form>
                </div>     
            </div>
        </div>
        <?php         
            endif;
        ?>
    </div>
</body>
</html>