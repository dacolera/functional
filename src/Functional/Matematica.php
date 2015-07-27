<?php

namespace Functional;

class Matematica 
{
    public function soma($a, $b) {
       // printf("%d + %d = ", $a, $b);
        $resultado = 0;
    
        $vai_um = 0;
        for ($bit = 0; $bit < 64; $bit++) {
            $bit_a = $a & (1 << $bit);
            $bit_b = $b & (1 << $bit);
    
            if ($bit_a & $bit_b) {
                if ($vai_um) { 
                    $resultado |= (1 << $bit); 
                }
                $vai_um = 1;
            } elseif ($bit_a | $bit_b) {
                if (!$vai_um) {
                    $resultado |= (1 << $bit); 
                }
            } elseif ($vai_um) {
                $resultado |= (1 << $bit); 
                $vai_um = 0;
            }
        }
        return $resultado;
    }
    
    protected function inverter($n1) {
        //fazer em binario
        return ($this->soma(~$n1,1));
    }
    
    public function multiplicacao($base, $multiplicador) 
    {
        
        $resultado = 0;
        for($i=1; $i<=$multiplicador; $i++) {
            $resultado = $this->soma($base,$resultado);
        }
        return $resultado;
    }
    
    public function subtracao($n1,$n2)
    {
        return $this->soma($n1,$this->inverter($n2));
    }
    
    public function divisao($dividendo,$divisor) 
    {
        if($divisor == 0){
            throw new \Exception("Divisao por zero nao permitida");
        }
        
        $resultado = 0;
        $div = $dividendo;
        while($div >= $divisor) {
            $div = $this->subtracao($div,$divisor);
            $resultado = $this->soma(1,$resultado);
        }
        //return sprintf("%s / %s = %s  , o resto da divisao foi %s",$dividendo,$divisor,$resultado,$div);
        return $resultado;
    }
    
    //@TODO
    // public function potencia($base, $expoente = 2);
    
    //@TODO usando o algol de Pell
     public function raizQuadrada($base)
     {
         $i = 1;
         $n = 0;
         while($base >= $i) {
             $base = $this->subtracao($base, $i);
             $i = $this->soma($i,2);
             $n = $this->soma($n,1);
         }
         return $n;
     }
    
    
}
