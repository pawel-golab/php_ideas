<?php
    function increment(&$a){
        $a = ($a & 1) + ($a | 1);
    }
    function decrement(&$a){
        $a = ($a ^ 1) - (!($a & 1) << 1);   
    }

    $x = 200;
    $y = -50;

    if( $y > 0 )
    {
        while($y > 0){
            increment($x);
            decrement($y);
        }
    }
    else
    {
        while($y < 0){
            decrement($x);
            increment($y);
        }
    }
    
    //wynik
    echo $x . PHP_EOL;
    
    
