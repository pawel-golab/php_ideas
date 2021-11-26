<?php

Class ArraysException extends Exception{};

Class Arrays
{
    public \Is $is;
    public \Each $each;
    public array $Array;

    public function __construct(...$values)
    {
        $this->Array = $values;
        $this->is = new Is($this->Array);
        $this->each = new Each($this->Array);
    }
    public function __toString()
    {
        $output = '';
        foreach( $this->Array as $i => $value ){
            $type = match(gettype($value)){
                'boolean'   => 'b',
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
}