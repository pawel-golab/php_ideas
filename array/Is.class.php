<?php

Class Is
{
    public array $Array;

    public function __construct( &$array ) //$array = Arrays->Array (umożliwia zapisywanie do innej klasy)
    {
        $this->Array = $array;
    }

    public function every($searched) :bool
    {
        foreach( $this->Array as $value ){
            if( $value != $searched ) return false;
        }        
        return true;
    }
    public function simple() :bool
    {
        $array = $this->Array;
        $searched = array_pop($array);
        foreach( $array as $value ){
            if( $value != $searched ) return false;
        }
        return true;
    }
    public function same() :bool
    {
        $array = $this->Array;
        $searched = array_pop($array);
        foreach( $array as $value ){
            if( $value !== $searched ) return false;
        }
        return true;
    }
    public function sameType() :bool
    {
        $array = $this->Array;
        $searched = gettype(array_pop($array));
        foreach( $array as $value ){
            if( gettype($value) != $searched ) return false;
        }
        return true;

    }

    public function ascending( bool $nondescending = false ) :bool
    {
        if($nondescending) return $this->nondescending();

        $array = $this->Array;
        $searched = gettype(array_pop($array));
        foreach( $array as $value ){
            if( $value < $searched ) return false;
            $searched = $value;
        }
        return true;
    }
    public function descending( bool $nonascending = false ) :bool
    {
        if($nonascending) return $this->nonascending();

        $array = $this->Array;
        $searched = gettype(array_pop($array));
        foreach( $array as $value ){
            if( $value > $searched ) return false;
            $searched = $value;
        }
        return true;
    }
    public function nonascending() :bool
    {
        $array = $this->Array;
        $searched = gettype(array_pop($array));
        foreach( $array as $value ){
            if( $value >= $searched ) return false;
            $searched = $value;
        }
        return true;
    }
    public function nondescending() :bool
    {
        $array = $this->Array;
        $searched = gettype(array_pop($array));
        foreach( $array as $value ){
            if( $value <= $searched ) return false;
            $searched = $value;
        }
        return true;
    }

    public function odd() :bool
    {
        foreach( $this->Array as $value ){
            if( $value % 2 == 0 ) return false;
        }
        return true;
    }
    public function even() :bool
    {
        foreach( $this->Array as $value ){
            if( $value & 1 ) return false;
        }
        return true;
    }

}
