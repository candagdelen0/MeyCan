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
                echo '<div class="col-md-2 col-sm-6 mx-auto p-2 border border-primary bg-info me-2 mt-2 text-center text-dark">
                    '. $masasonuc["ad"] .'
                </div>';

                
            endwhile;
        }









}

?>