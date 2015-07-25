<?php

    ini_set('display_errors',1);
    ini_set('display_startup_erros',1);
    error_reporting(E_ALL);


    
    function soma($a, $b) {
        printf("%d + %d = ", $a, $b);
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
    
    function multiplicacao($base, $multiplicador) 
    {
        
        $resultado = 0;
        for($i=1;$i<=$multiplicador) {
            $resultado = soma($base,$resultado);
        }
        return $resultado;
    }
    
    
    echo multiplicacao(10,2);