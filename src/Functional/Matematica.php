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

    function multiplicacao($fator1, $fator2) {
        if ($fator2 > 0) {
            return $fator2 == 1 ? $fator1 : $this->soma($fator1, $this->multiplicacao($fator1, $this->subtracao($fator2, 1)));	
        }
        return $this->multiplicacao($fator1, $fator2);
    }

    public function subtracao($n1,$n2)
    {
        return $this->soma($n1,$this->inverter($n2));
    }

    function divisao($dividendo, $divisor) {
        if ($divisor > 0) {
            return $divisor > $dividendo ? 0 : $this->soma(1, $this->divisao($this->subtracao($dividendo, $divisor), $divisor));
        } elseif ($divisor < 0) {
            return  $this->divisao($dividendo, $divisor);
        }    
        throw new \Exception('Divisao por zero nao permitida');
    }

    //@TODO
     public function potencia($base, $expoente = 2)
     {
	return $expoente == 1 ?
		 $base :
		 $this->multiplicacao($base, $this->potencia($base,$this->subtracao($expoente,1)));
     }

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
