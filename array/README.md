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
* -> add( int *$x* )
umożliwia dodanie liczby *$x* do każdego elementu tablicy
```php
$a = new Arrays(1,2,10,'a');
$a->each->add(2);
//result: [2,4,12,'c']
```
* -> sub( int *$x* )
umożliwia odjęcie liczby *$x* od każdego elementu tablicy
```php
$a = new Arrays(2,4,12,'c');
$a->each->sub(2);
//result: [1,2,10,'a']
```
