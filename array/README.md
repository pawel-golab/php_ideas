# Konstruktor
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
