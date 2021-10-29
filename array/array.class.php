<?php
    Class Arrays
    {
        private $array = [];
        
        public function __construct(...$values)
        {
            $this->array = $values;
        }
        public function __toString()
        {
            $output = '';
            foreach( $this->array as $i => $value ){
                $type = match(gettype($value)){
                    'bool'      => 'b',
                    'integer'   => 'i',
                    'float'     => 'f',
                    'string'    => 's',
                    'array'     => 'A',
                    'object'    => 'O',
                    default     => 'x'
                    
                };
                $output .= "- $i => $value ($type)\t"; 
            }
            return $output;
        }
        
        public function every($searched) :bool
        {
            foreach( $this->array as $value ){
                if( $value != $searched ) return false;
            }        
            return true;
        }
        
        public function simple() :bool
        {
            $array = $this->array;
            $searched = array_pop($array);
            foreach( $array as $value ){
                if( $value != $searched ) return false;
            }
            return true;
        }
    
        public function same() :bool
        {
            $array = $this->array;
            $searched = array_pop($array);
            foreach( $array as $value ){
                if( $value !== $searched ) return false;
            }
            return true;
        }
    
        public function sameType() :bool
        {
            $array = $this->array;
            $searched = gettype(array_pop($array));
            foreach( $array as $value ){
                if( gettype($value) != $searched ) return false;
            }
            return true;
            
        }
        
        public function ascending( bool $nondescending = false ) :bool
        {
            if($nondescending) return $this->nondescending();
            
            $array = $this->array;
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
            
            $array = $this->array;
            $searched = gettype(array_pop($array));
            foreach( $array as $value ){
                if( $value > $searched ) return false;
                $searched = $value;
            }
            return true;
        }
        
        public function nonascending() :bool
        {
            $array = $this->array;
            $searched = gettype(array_pop($array));
            foreach( $array as $value ){
                if( $value >= $searched ) return false;
                $searched = $value;
            }
            return true;
        }
        
        public function nondescending() :bool
        {
            $array = $this->array;
            $searched = gettype(array_pop($array));
            foreach( $array as $value ){
                if( $value <= $searched ) return false;
                $searched = $value;
            }
            return true;
        }
    }
    
    $a = new Arrays(5,'5',5,5,5);
    
    echo $a , PHP_EOL;
    
    echo 'Every element is equal to 5? ' , $a -> every(5) ? 'T' : 'F' , PHP_EOL;
    echo 'Are array values in ascending/descending/nonascending/nondescending order? '
        , $a -> ascending()         ? 'T/' : 'F/'
        , $a -> ascending(true)     ? 'T/' : 'F/'
        , $a -> descending()        ? 'T/' : 'F/'
        , $a -> descending(true)    ? 'T' : 'F' , PHP_EOL; 
    echo 'simple && sameType = same' , PHP_EOL;
    echo $a -> simple() ? 'T' : 'F' , ' && ' , $a -> sameType() ? 'T' : 'F' , ' = ' , $a -> same() ? 'T' : 'F'; 
    

