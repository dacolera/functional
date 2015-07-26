<?php

    ini_set('display_errors',1);
    ini_set('display_startup_erros',1);
    error_reporting(E_ALL);

    
    function soma($a, $b) {
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
    
    function inverter($n1) {
        //fazer em binario
        return -$n1;
    }
    
    function multiplicacao($base, $multiplicador) 
    {
        
        $resultado = 0;
        for($i=1; $i<=$multiplicador; $i++) {
            $resultado = soma($base,$resultado);
        }
        return $resultado;
    }
    
    function subtracao($n1,$n2)
    {
        return soma($n1,inverter($n2));
    }
    
    function divisao($dividendo,$divisor) 
    {
        $resultado = 0;
        $div = $dividendo;
        while($div >= $divisor) {
            $div = subtracao($div,$divisor);
            $resultado = soma(1,$resultado);
        }
        return sprintf("%s / %s = %s  , o resto da divisao foi %s",$dividendo,$divisor,$resultado,$div);
    }
    
    function potencia($base,$expoente = 2)
    {
        $resultado  = 0;
        while($expoente > 1) {
            $resultado = soma(multiplicacao($base,$base),$resultado);
            $expoente = subtracao($expoente,1);
        }
        return $resultado; 
    }
    
    echo potencia(3,3); 