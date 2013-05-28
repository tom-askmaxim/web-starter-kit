<?php


function ckdouble($start,$chk){
    foreach ($start as $key => $value) {
        if($chk[0] >= $value[0] && $chk[1] <= $value[1])
            return $start[$key];
    }
}


?>
