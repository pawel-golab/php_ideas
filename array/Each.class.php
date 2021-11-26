<?php

class Each
{
    public array $Array;

    public function __construct( &$array )
    {
        $this->Array = &$array;
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
        if( $divisor == 0 )
            throw new ArraysException("Division by 0");

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
        if( $modulus == 0 )
            throw new ArraysException("Division by 0");

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
    public function rt( int $degree = 2 ) :void
    {
        if( $degree == 0 )
            throw new ArraysException("Division by 0");

        if( $degree == 1 )
            return;

        $this->Array = array_map(
            fn($val) => pow($val, 1/$degree),
            $this->Array
        );
    }
}