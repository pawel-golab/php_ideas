function plural($n, $a, $b, $c)
	{
		if($n == 1)
			return $a;
			
		if($n % 10 >= 2 && $n % 10 <= 4 && intdiv($n%100, 10) != 1 )
			return $b;
			
		return $c;
	}
	
	function ago($datetime)
	{
	    $s = '';
	    $n = 0;
		$d = new DateTime();
	    $interval = $d->diff($datetime);
	    
	    if (($n = $interval->y) >= 1)
	    {
	    	$s = plural($n, 'rok', 'lata', 'lat');
	    }
	    else if (($n = $interval->m) >= 1)
	    {
	    	$s = plural($n, 'miesiąc', 'miesiące', 'miesięcy');
	    }
	    else if (($n = $interval->d) >= 1)
	    {
	    	$s = plural($n, 'dzień', 'dni', 'dni');
	    }
	    else if (($n = $interval->h) >= 1)
	    {
	    	$s = plural($n, 'godzina', 'godziny', 'godzin');
	    }
	    else
	    {
	    	$s = plural($n, ' minuta', ' dni', ' dni');
	    }
	    
	    return "$n $s temu";
	}
