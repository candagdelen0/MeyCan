<?php
$db = new mysqli("localhost","root","","meyhane") or die ("Bağlanamadı");
$db->set_charset("utf8");

class Sistem {
    function sorgum($vt,$sorgu,$getres) {
        $a = $vt->prepare($sorgu);
        $a->execute();
        if ($getres==1):
            return $b = $a->get_result();
        endif;
    }

    function masagetir($vt) {
        $masalar = "SELECT * FROM masalar";
        $sonuc=$this->sorgum($vt,$masalar,1);
        while($masasonuc=$sonuc->FETCH_ASSOC()):
            $siparisler = 'SELECT * FROM  siparisler WHERE masaid ='.$masasonuc["id"].' ';
            $this->sorgum($vt, $siparisler,1)->num_rows == 0 ? $renk = "info" : $renk = "success";
            echo '<div class="col-md-2 col-sm-6">
                <a href="masadetay.php?masaid='.$masasonuc["id"].' ">
                <div class=" mx-auto p-2 border border-primary bg-'.$renk.' me-2 mt-2 text-center text-dark">'. $masasonuc["ad"] .'</div></a>
            </div>'; 
        endwhile;
    }

    function masaac($vt, $id) {
        $get = "SELECT * FROM masalar WHERE id=$id";
        return $this->sorgum($vt,$get,1);
    }
}

?>