<?php
//KLUCZE OD 1 DO 10

//jeżeli wylosujesz 10 - losuj od 1 do 10
//jeżeli 9 - losuj od 1 do 9
//jeżeli n - losuj od 1 do n    (n c <1;10>)

$sum = array_fill(1,10,0);
foreach( range(1,1000000) as $i ){
    $r = rand(1,rand(1,10));
    $sum[$r]++;
}

for( $x = 0, $denominator = 100; $denominator > 0; $denominator -= 10){//można zmiejszyć denominator i 100/denominator
    $x = $x + 1/$denominator;
    $precise []= $x;
}
$precise []= 0; //klucze są od 1 do 10

// porównianie tablic

$sum = array_map(
    fn($x) => $x/10000 . '%',
    $sum
);

$precise = array_reverse($precise);
$precise = array_map(
    fn($x) => $x*100 . '%',
    $precise
);

foreach( range(1,10) as $i ){
    echo $sum[$i] , "\t ~ \t" , $precise[$i] . PHP_EOL;
}

echo <<<E
    
    INFO:
    Losuj od 1 do <1;10>
    (10) => 1/10 * 1/10\t(10) można otrzymać tylko przy losowaniu od 1 do 10
    (9) =>  1/10 * 1/10 + 1/10 * 1/9 = (10) + 1/10 * 1/9\t(9) można otrzymać przy losowaniu od 1 do 10 i 1 do 9
    (8) =>  (10) + (9) + 1/10 * 1/8
    ...
    (1) => (10) + (9) + (8) + ... + 1/10 * 1
E;
