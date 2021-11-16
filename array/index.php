<?php
    spl_autoload_register(
      fn($class) => include $class . ".class.php";
    );
 
    $a = new Arrays(5,'5',5,5,5);
    $b = new Arrays();
    $b->Array = [1 => 8, '3' => true*2, 'x' => ['x'], 0 => 1, !true, 'foo',![]];
    
    echo "a[] = $a" , PHP_EOL;
    echo "b[] = $b" , PHP_EOL;
    
    echo 'Every element is equal to 5? ' , $a -> is -> every(5) ? 'T' : 'F' , PHP_EOL;
    echo 'Are array values in ascending/descending/nonascending/nondescending order? '
        , $a -> is -> ascending()         ? 'T/' : 'F/'
        , $a -> is -> ascending(true)     ? 'T/' : 'F/'
        , $a -> is -> descending()        ? 'T/' : 'F/'
        , $a -> is -> descending(true)    ? 'T' : 'F'
        , PHP_EOL; 
    echo 'Are all values odd/even?'
        , $a -> is -> odd()   ? 'T/' : 'F/'
        , $a -> is -> even()  ? 'T' : 'F'
        , PHP_EOL;
    echo 'simple && sameType = same' , PHP_EOL;
    echo $a -> is -> simple() ? 'T' : 'F' , ' && ' , $a -> is -> sameType() ? 'T' : 'F' , ' = ' , $a -> is -> same() ? 'T' : 'F', PHP_EOL;
    echo 'suma: ' , $a->sum() , PHP_EOL;
    echo 'typ numerowania tablicy a, b: ', $a->arrayType(), ' ', $b->arrayType() , PHP_EOL;
    echo 'typ wartości w tablicy a, b: ', $a->type(), ' ', $b->type() , PHP_EOL;
    
    echo $a(1), ' ', $b(0), ' ', $b(2), ' ', $b('3'), ' ', $b();

?>
