<ul>
    <li><h2>klasa CMD</h2></li>
    <ul>
        <li><h3>displayList( array $list, array $bullet )</h3></li>
        <p> <b>Argumenty:</b> <ul>
            $list - lista do wyświetlenia<br>
            $bullet - definicja punktorów listy
        </ul> </p>
        <p>
            $bullet jest tablicą zwierające dwuelementowe tablice: [ [punktor, ?flagi], [punktor, ?flagi], ... ]<br>
            Każda tablica definiuje wygląd punktora dla następnego zagnieżdżenia, np.:<br>
            <code>displayList( [1,2,[3,4],5,6], [ ['>'], ['-'] ] );</code><br>
            Wyświetli:<br>
            <i>Zauważ, że flagi nie zostały zapisane flagi jako drugi element podtablic</i>
            <pre>
> 1
> 2
    - 3
    - 4
> 5
> 6</pre></p>
        <p>
            Dostępne flagi:
            <pre>
INCREMENT   -   każdy następny punkt będzie inkrementowany (1 -> 1,2,3; a -> a,b,c; 8 -> 8,9,10)
DUPLICATE   -   każdy element ma zduplikowany symbol rodzica (- -> --; * -> **)
INHERIT     -   każdy element ma po symbolu rodzica kropkę i własną numerację (1 1 -> 1.1, 1.2; # a -> #.a, #.b)
            </pre>
        </p>
    </ul>
</ul>
