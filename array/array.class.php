<?php
    Class Arrays
    {
        private $Aarray = [];
        
        public function __construct(...$values)
        {
            $this->Array = $values;
        }
        public function __toString()
        {
            $output = '';
            foreach( $this->Array as $i => $value ){
                $type = match(gettype($value)){
                    'bool'      => 'b',
                    'integer'   => 'i',
                    'float'     => 'f',
                    'string'    => 's',
                    'array'     => 'A',
                    'object'    => 'O',
                    default     => 'x'
                    
                };
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
            /*finally{
                return false;
            }*/
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
    
    $a = new Arrays(5,'5',5,5,5);
    $b = new Arrays(8,true,['x'],1,!false,'foo',![]);
    
    echo $a , PHP_EOL;
    
    echo 'Every element is equal to 5? ' , $a -> every(5) ? 'T' : 'F' , PHP_EOL;
    echo 'Are array values in ascending/descending/nonascending/nondescending order? '
        , $a -> ascending()         ? 'T/' : 'F/'
        , $a -> ascending(true)     ? 'T/' : 'F/'
        , $a -> descending()        ? 'T/' : 'F/'
        , $a -> descending(true)    ? 'T' : 'F'
        , PHP_EOL; 
    echo 'Are all values odd/even?'
        , $a -> odd()   ? 'T/' : 'F/'
        , $a -> even()  ? 'T' : 'F'
        , PHP_EOL;
    echo 'simple && sameType = same' , PHP_EOL;
    echo $a -> simple() ? 'T' : 'F' , ' && ' , $a -> sameType() ? 'T' : 'F' , ' = ' , $a -> same() ? 'T' : 'F', PHP_EOL;
    echo 'suma: ' , $a->sum();
