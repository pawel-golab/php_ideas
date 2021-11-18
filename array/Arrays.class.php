<?php

Class ArraysException extends Exception{};

Class Arrays
{
    public $is;
    public $Array = [];

    public function __construct(...$values)
    {
        $this->Array = $values;
        // $this->is = new Is($this->Array);
    }
    public function __toString()
    {
        $output = '';
        foreach( $this->Array as $i => $value ){
            $type = match(gettype($value)){
                'boolean'      => 'b',
                'integer'   => 'i',
                'double'    => 'f',
                'string'    => 's',
                'array'     => 'A',
                'object'    => 'O',
                default     => 'x'

            };
            if( $type == 'A' )
                $output .= "$i => [?]\t";
            else
                $output .= "$i => $value ($type)\t"; 
        }
        return $output;
    }
    public function __call( $name, $arguments )
    {
        try{
            return call_user_func_array( 'array_' . $name , [$this->Array, ...$arguments] );
        }
        catch(TypeError $e){
            return call_user_func_array( $name , [$this->Array, ...$arguments] );
        }
        finally{
            return false;
        }
    }
    public function __invoke( $offset = null )
    {
        return $this->Array[$offset] ?? 0;
    }
    
    public function arrayType() :string
    {
        $indexed = 0;
        $associative = 0;

        foreach( $this->Array as $key => $value ){
            if(gettype($key) == 'integer')
                $indexed++;
            else
                $associative++;

            if($indexed > 0 && $associative > 0)
                return 'mixed';
        }
        if($indexed > 0) return 'indexed'; return 'assiciative';
    }
    public function type() :string
    {
        $array = $this->Array;
        $searched = gettype(array_pop($array));

        foreach( $array as $value ){
            if( $searched != gettype($value) )
                return "mixed";
        }

        return $searched;
    }
    
    public function add( mixed $addend ) :void
    {
        if( $addend == 0 )
            return;
            
        $this->Array = array_map(
            fn($val) => $val + $addend, 
            $this->Array
        );
    }    
    public function sub( mixed $subtrahent ) :void
    {
        if( $subtrahent == 0 )
            return;
            
        $this->Array = array_map(
            fn($val) => $val - $subtrahent, 
            $this->Array
        );
    }
    public function mul( mixed $multiplier ) :void
    {
        if( $multiplier == 0 ) {
            $this->Array = array_fill( 0, count($this->Array), 0 );
            return;
        }
        if( $multiplier == 1 )
            return;
            
        $this->Array = array_map(
            fn($val) => $val * $multiplier, 
            $this->Array
        );
    }
    public function div( mixed $divisor ) :void
    {
        if( $divisor == 0 ) {
            throw new ArraysException("Division by 0");
            return;
        }
        if( $divisor == 1 )
            return;
            
        $this->Array = array_map(
            fn($val) => $val / $divisor, 
            $this->Array
        );
    }
    public function pow( mixed $power ) :void
    {
        if( $power == 0 ) {
            $this->Array = array_fill( 0, count($this->Array), 1 );
            return;
        }
        if( $power == 1 )
            return;
            
        $this->Array = array_map(
            fn($val) => $val ** $power, 
            $this->Array
        );
    }
    public function mod( mixed $modulus ) :void
    {
        if( $modulus == 0 ) {
            throw new ArraysException("Division by 0");
            return;
        }
        if( $modulus == 1 )
            return;
            
        $this->Array = array_map(
            fn($val) => $val % $modulus, 
            $this->Array
        );
    }
    public function comp() :void //complement?
    {
        $this->Array = array_map(
            fn($val) => 10 ** ceil(log10($val)) - $val, //(int)ceil... aby zwracany typ był poprawny
            $this->Array
        );
    }
    public function sqrt() :void
    {
        $this->Array = array_map(
            fn($val) => sqrt($val), 
            $this->Array
        );
    }
}

/*$a = new Arrays(6,12,0,42);
echo "\$a[] =\t\t$a" . PHP_EOL;

$a->add(3);
echo "\$a->add(3) =\t$a" . PHP_EOL;

$a->sub(6);
echo "\$a->sub(6) =\t$a" . PHP_EOL;

$a->mul(2);
echo "\$a->mul(2) =\t$a" . PHP_EOL;

$a->div(3);
echo "\$a->div(3) =\t$a" . PHP_EOL;

$a->pow(4);
echo "\$a->pow(2) =\t$a" . PHP_EOL;

$a->mod(10);
echo "\$a->mod(10) =\t$a" . PHP_EOL;

$a->comp();
echo "\$a->comp() =\t$a" . PHP_EOL;

$a->sqrt();
echo "\$a->sqrt() =\t$a" . PHP_EOL;*/
