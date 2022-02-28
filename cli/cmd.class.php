<?php
	/* displayList( ['x','y','z'], [[1,ITERATE]] )
		1 x
		2 y
		3 z
	   displayList( ['a','b','c'], [[21,ITERATE]])
	   	21 a
		22 b
		23 c
	*/
	define( 'ITERATE', 1 );
	/* displayList( ['k',['l','m'],'n' ], [['-',DUPLICATE]] )
		- k
			-- l
			-- m
		- n
		//works only if [,DUPLICATE] is last argument: ([ ['-',DUPLICATE], [1,ITERATE] ]) won't work
	*/
	define( 'DUPLICATE', 2 );
	/* displayList( ['o',['p','q'],'r' ], [['#',INHERIT],[1,ITERATE]] )
		# o
			#.1 p
			#.2 q
		# r
	*/
	define( 'INHERIT', 4 );

	/**
	 * Class created to modify console output
	 */
	class CMD
	{
		private /*int*/ $Width;

		public function __construct()
		{
			exec('mode con', $out);
			$this->Width = (int) trim( explode( ':', $out[4] )[1] );
		}

		/**
		 * Prints given text with specified colors and styles
		 * 
		 * @param string $text text to be styled
		 * @param string|int $color color (number or name) (30=black, 31=red, 32=green, 33=yellow, 34=blue, 35=magenra, 36=cyan, 37=gray) (0->30,1->31,...)
		 * @param string|int $style style (numer or name) (0=reset, 1=bold, 4=underline, 7=reverse)
		 * @param bool $light whether text will be light (false->dark,true->light (basic RGB color)) (in Windows bold=light)
		 */
		public function style( string $text, /*string|int*/ $color = 39, /*string|int*/ $style = 0, bool $light = true ) :string
		{
			$colorCode = 39;

			#region color the text

			if( is_numeric($color) ) // gettype($color) == 'integer' // nie może być w przypadku konsoli (argument jest zawsze stringiem)
			{
				$color = (int)$color;
				// number from 0 to 7	// red - 1 -> 30, gray - 7 -> 37
				if( ($color | 7) == 7 )
					$colorCode = $color + 30;
				else $colorCode = $color;

				if( $light && $colorCode < 90 ) $colorCode += 60;
			}
			else
			{
				switch ($color) {
					case 'black':	$colorCode = 30; break;		// "light" black = dark gray
					case 'red':		$colorCode = 31; break;
					case 'green':	$colorCode = 32; break;
					case 'yellow':	$colorCode = 33; break;
					case 'blue':	$colorCode = 34; break;
					case 'magenta':	$colorCode = 35; break;
					case 'cyan':	$colorCode = 36; break;
					case 'gray':	$colorCode = 37; break;		// "light" gray = white
				}
				/*$colorCode = match($color){
					'black' => 30,		// "light" black = dark gray
					'red' => 31,
					'green' => 32,
					'yellow' => 33,
					'blue' => 34,
					'magenta' => 35,
					'cyan' => 37,
					'gray' => 38		// "light" gray = white
				};*/
				if( $light ) $colorCode += 60;;
			}

			#endregion
			#region style the text

			$styleCode = $style;

			if( !is_numeric($style) ) // gettype($style) == 'string' // nie może być w przypadku konsoli (argument jest zawsze stringiem)
			{
				switch ($style) {
					case 'bold':		$styleCode = 1; break; //doesn't work on windows' cmd (bold = light)
					case 'underline':	$styleCode = 4; break;
					case 'reverse':		$styleCode = 7; break;
				}
			}

			#endregion
			return "\033[{$styleCode};{$colorCode}m{$text}\033[0m";
		}

		/**
		 * short form of: echo ->style();
		 */
		public function echo( string $text, /*string|int*/ $color = 39, /*string|int*/ $style = 0, bool $light = true ) :void
		{
			echo $this->style( $text, $color, $style, $light);
		}

		/**
		 * Aligns given text to the middle (vertically)
		 * 
		 * @param string $text text to be aligned
		 * @param string $char string that will fill repeatedly empty space
		 * @param int $spaceLen length of left and right margin which seperates $char's from $text
		 * @param int $marginLen length of left and right margin which seperates generated box from cmd borders
		 * @param string|int $color color (number or name) (30=black, 31=red, 32=green, 33=yellow, 34=blue, 35=magenra, 36=cyan, 37=gray) (0->30,1->31,...)
		 * @param string|int $style style (numer or name) (0=reset, 1=bold, 4=underline, 7=reverse)
		 * @param bool $light whether text will be light (false->dark,true->light (basic RGB color)) (in Windows bold=light)
		 */
		public function center( string $text, string $char = ' ', int $spaceLen = 1, int $marginLen = 0, /*string|int*/ $color = 39, /*string|int*/ $style = 0, bool $light = true ) :string
		{
			if( $spaceLen < 0 ) $spaceLen = 0;
			
			return PHP_EOL . str_pad(
				str_pad(
					str_pad(
						$this->style( $text, $color, $style, $light ), //TODO
						//$text,
						strlen($text) + 2*$spaceLen,
						' ',
						STR_PAD_BOTH
					), // pad text with spaces (to seperate it from $char)
					$this->Width - 2*$marginLen,
					$char,
					STR_PAD_BOTH
				), // pad text with $char
				$this->Width,
				' ',
				STR_PAD_BOTH
			) // pad box with spaces (to seperate it from cmd borders)
			.PHP_EOL; 
		}

		/**
		 * Displays line
		 * 
		 * @param string $char string that will fill whole line
		 * @param int $marginLen length of left and right margin which seperates generated box from cmd borders
		 */
		public function displayLine( string $char = '#', int $marginLen = 0 ) :void
		{
			echo PHP_EOL, str_pad(
				str_pad( '', $this->Width - 2*$marginLen, $char ),
				$this->Width,
				' ',
				STR_PAD_BOTH
			), PHP_EOL;
		}

		/**
		 * Displays title - 5 lines (full top and bottom line, top-middle and bottom-middle line with margin and middle line with text)
		 * 
		 * @param string $text text to be aligned (in third line)
		 * @param string $char string that will: fill whole 1st. and last line, fill partly 2nd and 4th line, fill empty space of middle line.\nIf $char is array, [0] will fill 1st line, [1] second, [2] third etc.
		 * @param int $spaceLen length of left and right margin which seperates $char from $text
		 * @param int $marginLen length of left and right margin which seperates generated box from cmd borders
		 * @param string|int $color color (number or name) FOR $text ONLY (30=black, 31=red, 32=green, 33=yellow, 34=blue, 35=magenra, 36=cyan, 37=gray) (0->30,1->31,...)
		 * @param string|int $style style (numer or name) FOR $text ONLY (0=reset, 1=bold, 4=underline, 7=reverse)
		 * @param bool $light whether text will be light (false->dark,true->light (basic RGB color)) (in Windows bold=light)
		 */
		public function displayTitle( string $text, /*array|string*/ $char = ' ', int $spaceLen = 1, int $marginLen = 0, /*string|int*/ $color = 39, /*string|int*/ $style = 0, bool $light = true ) :void
		{
			$textLen = strlen($text);

			if( gettype($char) == 'string' ) // string|array $char
			{

				$m13 = $this->center(
					str_pad( '', $textLen, ' ', STR_PAD_BOTH ),
					$char,
					$spaceLen,
					$marginLen
				); // 2nd and 4th line

				$this->displayLine( $char, $marginLen );
				echo $m13;
				echo $this->center( $text, $char, $spaceLen, $marginLen, $color, $style, $light );
				echo $m13;
				$this->displayLine( $char, $marginLen );
			}
			else //array
			{
				for( $i = 0; $i < 5; $i++ )
				{
					if( key_exists( $i, $char ) ) continue;
					else $char[$i] = $char[$i-1];
				}
				
				// line 1 and 3 (second and fourth):
				$m1 = $this->center(
					str_pad( '', $textLen, ' ', STR_PAD_BOTH ),
					$char[1],
					$spaceLen,
					$marginLen
				);

				if( $char[1] == $char[3] )
					$m3 = $m1;
				else
				{
					$m1 = $this->center(
						str_pad( '', $spaceLen * 2 + $textLen, ' ', STR_PAD_BOTH ),
						$char[3],
						0,
						$marginLen
					);
				}

				$this->displayLine( $char[0], $marginLen );
				echo $m1;
				echo $this->center( $text, $char[2], $spaceLen, $marginLen );
				echo $m3;
				$this->displayLine($char[4], $marginLen );
			}
		}

		//TODO: duplicate list bullet
		// - coś
		//	-- coś.1
		//	-- coś.2
		// - coś2
		// if(!key_exists($depth,$bullet)) => check if last_bullet has DUPLICATE flag

		/**
		 * Display array as ordered/unordered list
		 * 
		 * @param array $list array to be printed
		 * @param array[mixed,?bool] $bullet $bullet[0] - bullet symbol, $bullet[1] determines if list is ordered ($bullet[0] will be incremented if $bullet[1] is true)
		 */
		public function displayList( array $list, array $bullet = [ [1,ITERATE], ['a',ITERATE], '>' ] ) :void
		{
			$last_bullet = $bullet[ array_key_last($bullet) ];	//[count($bullet)-1] //should be used on lists (incremented arrays)

			$recursive = function( $list, $depth ) use ( $bullet, $last_bullet, &$recursive )
			{
				foreach ( $list as $key => $element )
				{
					for( $i = 0; $i < $depth; $i++ )
						echo "\t";

					if( is_array($element) )
					{
						echo PHP_EOL;
						$recursive( $element, $depth+1 );
					}
					else
					{

						if( key_exists( $depth, $bullet ) )		// punktor dla danego zagłębienia został zdefiniowany (np.: $bullet = [1,'a','>']; dla 2 prawda, dla 4 fałsz)
						{
							if( isset($bullet[1]) && ($bullet[1] & 1) )	//ITERABLE
								$current_bullet = &$bullet[$depth];		//& - for iterating
							else
								$current_bullet = $bullet[$depth];
						}
						else
						{
							$safe_last_bullet = $last_bullet;	// constant and non-reference

							if( isset($last_bullet[1]) && ($last_bullet[1] & 1) )
								$current_bullet = &$last_bullet;	//& - for iterating

							if( isset($last_bullet[1]) && ($last_bullet[1] & 2) ) //TODO: naprawić ITERATE|DUPLICATE
								$current_bullet = [$last_bullet[0] . $last_bullet[0], $last_bullet[1]];
								//zagnieżdżanie np. -
								//	- jeden
								//		-- podjeden 1
								//		-- podjeden 2
								//	- dwa

							else $current_bullet = $last_bullet;
						}
						echo $current_bullet[0], ' ', $element, PHP_EOL;

						if( isset($current_bullet[1]) && ($current_bullet[1] & 1) )	//iterate list element number // !empty(x) => isset(x) && x == true 
							$current_bullet[0]++;
					}
				}
			};

			$recursive( $list, 0 );
			
		}
	}
	$cmd = new CMD();

	echo PHP_EOL, '->echo( "Lorem ipsum", "magenta", "underline", true):', PHP_EOL;
	$cmd->echo( 'Lorem ipsum', 'magenta', 'underline', true );

	echo PHP_EOL, '->displayLine( "-= =-" ):', PHP_EOL;
	$cmd->displayLine( '-= =-' );

	echo PHP_EOL, 'echo ->center( "Lorem ipsum", "-+", 2, 10 ):', PHP_EOL;
	echo $cmd->center( 'Lorem ipsum', '-+', 2, 10 );

	echo PHP_EOL, "->displayTitle( \"Lorem ipsum\", ['-','=','-=','=','-'], 5, 20 ):", PHP_EOL;
	$cmd->displayTitle('Lorem ipsum dolor sit amet consectetur adipisicing elit.',['-','=','-=','=','-'],5,20);

	echo PHP_EOL, '->displayTitle( "Lorem ipsum", "~", 10, 40, "blue", "bold" ):', PHP_EOL;
	$cmd->displayTitle('Lorem ipsum dolor sit amet consectetur adipisicing elit.', '~', 10, 40, 'blue', 'bold'); 

	echo PHP_EOL, $cmd->displayList(
		['jeden','dwa','trzy','cztery',['a','b',['!','@',[99,98,97,['A','B',['C','D']]]],'c',['+','-']],'pięć'],
		//TODO: trzecie nawiasty [] są dwa razy otwierane (['!','@' ...],'c',[...]) przez co leczenie jest od nowa
		[ [1,ITERATE], ['a',ITERATE], ['->',DUPLICATE] ]
	);
?>
