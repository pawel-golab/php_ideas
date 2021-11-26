<?php
    const BR = '<br>';

    spl_autoload_register(
      fn($class) => include __DIR__ . '/' . $class . '.class.php'
    );

    $b = new Arrays();
    $b->Array = [1 => 8, '3' => true*2, 'x' => ['x'], 0 => 1, !true, 'foo',![]];
    
    $a = new Arrays(6,12,0,42);

    echo "<pre style='font-size: large'>";
    echo "\$a[] =           $a" . BR;

    $a->each->add(3);
    echo "\$a->add(3)   =   $a      each + x" . BR;

    $a->each->sub(6);
    echo "\$a->sub(6)   =   $a      each - x" . BR;

    $a->each->mul(2);
    echo "\$a->mul(2)   =   $a      each * x" . BR;

    $a->each->div(3);
    echo "\$a->div(3)   =   $a      each / x" . BR;

    $a->each->pow(4);
    echo "\$a->pow(2)   =   $a      each ^ x" . BR;

    $a->each->mod(10);
    echo "\$a->mod(10)  =   $a      each % x" . BR;

    $a->each->comp();
    echo "\$a->comp()   =   $a      1En - each" . BR;

    $a->each->sqrt();
    echo "\$a->sqrt()   =   $a      √each" . BR;

    echo "</pre>";