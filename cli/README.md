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
            Wyświetli:
            <pre>
> 1
> 2
    - 3
    - 4
> 5
> 6</pre></p>
        <p>
            <i>Zauważ, że flagi nie zostały zapisane</i><br>
            Dostępne flagi:
        </p>
    </ul>
</ul>
