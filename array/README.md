# Tworzenie obiektu
* "Deklaracja" + przypisanie
```php
// *lista - tablica w której pierwszy element ma indeks 0, a kazy kolejny element ma indeks o jeden większy
$a = new Arrays();
$a->Array = [1,2,3,5,8,13];           //lista z intami
$a->Array = ['a','b','b'];            //lista ze straingami
$a->Array = ['a',true,'b',[2,3]];     //lista mieszana
$a->Array = [1=>'a',10=>'b','x'=>'c'];//tablica mieszana
```
* Inicjalizacja
```php
$a = new Arrays(1,2,3,5,8,13);  //tylko jako lista
```
# metody
* -> arrayType()<br>
zwraca typ tablicy (indeksowana/asocjacyjna/mieszana)
```php
$i = new Arrays(1,2,3);
$i->arrayType();    //"indexed"
$i2 = new Arrays(1=>10,5=>2,15=>321);
$i2->arrayType()    //"indexed"
$a = new Arrays('a'=>1,'b'=>10,'c'=>123);
$a->arrayType()     //"associative"
$m = new Arrays(1,'b'=>10,1=>123);
$m->arrayType()     //"mixed"
```
* -> type()<br>
zwraca typ danych w tablicy (o ile jest jednolity)
```php
$i = new Arrays(1,5,12);
$i->type()    //"integer"
$d = new Arrays(.0,2e3,3.14);
$d->type()    //"double"
$s = new Arrays(1 . 2, 'abc', 'word');
$s->type()    //"string"
$a = new Arrays([1,2],['a','b'],[['x'],['y']]);
$a->type()    //"array"
$m = new Arrays(100,0.333,'text',false);
$a->type()    //"mixed"
```
# -> each
* -> add( int *$x* )<br>
umożliwia dodanie liczby *$x* do każdego elementu tablicy
```php
$a = new Arrays(1,2,10);
$a->each->add(2);
//result: [3,4,12]
```
* -> sub( int *$x* )<br>
umożliwia odjęcie liczby *$x* od każdego elementu tablicy
```php
$a = new Arrays(3,4,12);
$a->each->sub(2);
//result: [1,2,10]
```
* -> mul( int *$x* )<br>
umożliwia pomnożenie każdego elementu tablicy razy *$x*
```php
$a = new Arrays(1,2,10);
$a->each->mul(2);
//result: [2,4,20]
```
* -> div( int *$x* )<br>
umożliwia podzielenie każdego elementu tablicy przez *$x*
```php
$a = new Arrays(2,4,20);
$a->each->div(2);
//result: [1,2,10]
```
* -> pow( int *$x* )<br>
umożliwia podniesienie każdego elementu tablicy do *$x*-tej potęgi
```php
$a = new Arrays(2,4,20);
$a->each->pow(3);
//result: [8,64,8000]
```
* -> rt( int *$x* = 2 )<br>
umożliwia obliczenie pierwiastka *$x*-tego stopnia dla każdego elementu tablicy
```php
$a = new Arrays(8,64,8000);
$a->each->rt(3);
```
* -> sqrt()<br>
umożliwia obliczenie pierwiastka kwadratowego dla każdego elementu tablicy
```php
$a = new Arrays(9,64,400);
$a->each->sqrt();
//result: [3,16,20]
```
* -> mod( int *$x* )<br>
umożliwia obliczenie reszty z dzielenia każdego elementu tablicy przez *$x* 
```php
$a = new Arrays(1,5,9);
$a->each->mod(3);
//result: [1,2,0]
```
* -> comp()<br>
umożliwia obliczenie różnicy pomiędzy najbliższą potęgą 10 a każdym elementem tablicy 
```php
$a = new Arrays(7,68,999);
$a->each->comp();
//result: [3,32,1]
```
