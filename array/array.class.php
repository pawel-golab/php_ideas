<?php

    Class Is
    {
        public $Array;
        
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
    Class Arrays
    {
        public $is;
        public $Array = [];
        
        public function __construct(...$values)
        {
            $this->Array = $values;
            $this->is = new Is($this->Array);
        }
        public function __toString()
        {
            $output = '';
            foreach( $this->Array as $i => $value ){
                $type = match(gettype($value)){
                    'boolean'      => 'b',
                    'integer'   => 'i',
                    'float'     => 'f',
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
    }
    
    $a = new Arrays(5,'5',5,5,5);
    $b = new Arrays();
    $b->Array = [1 => 8, '3' => true*2, 'x' => ['x'], 0 => 1, !true, 'foo',![]];
    
    echo "a[] = $a" , PHP_EOL;
    echo "b[] = $b" , PHP_EOL;
    
    echo 'Every element is equal to 5? ' , $a -> is -> every(5) ? 'T' : 'F' , PHP_EOL;
    echo 'Are array values in ascending/descending/nonascending/nondescending order? '
        , $a -> is -> ascending()         ? 'T/' : 'F/'
        , $a -> is -> ascending(true)     ? 'T/' : 'F/'
        , $a -> is -> descending()        ? 'T/' : 'F/'
        , $a -> is -> descending(true)    ? 'T' : 'F'
        , PHP_EOL; 
    echo 'Are all values odd/even?'
        , $a -> is -> odd()   ? 'T/' : 'F/'
        , $a -> is -> even()  ? 'T' : 'F'
        , PHP_EOL;
    echo 'simple && sameType = same' , PHP_EOL;
    echo $a -> is -> simple() ? 'T' : 'F' , ' && ' , $a -> is -> sameType() ? 'T' : 'F' , ' = ' , $a -> is -> same() ? 'T' : 'F', PHP_EOL;
    echo 'suma: ' , $a->sum() , PHP_EOL;
    echo 'typ numerowania tablicy a, b: ', $a->arrayType(), ' ', $b->arrayType() , PHP_EOL;
    echo 'typ wartości w tablicy a, b: ', $a->type(), ' ', $b->type() , PHP_EOL;
    
    echo $a(1), ' ', $b(0), ' ', $b(2), ' ', $b('3'), ' ', $b();
