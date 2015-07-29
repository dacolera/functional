<?php

namespace Functional;

class Matematica
{
    public function somar($a, $b)
    {
        return $a + $b;
    }

    public function subtrair($a, $b)
    {
        return $a - $b;
    }

    public function multiplicar($fator1, $fator2) {
        if ($fator2 < 0) {
            return - $this->multiplicar($fator1, abs($fator2));
        } else {
            return $fator2 == 1 ? $fator1 : $this->somar($fator1, $this->multiplicar($fator1, $this->subtrair($fator2, 1)));
        }
    }

    public function dividir($dividendo, $divisor)
    {
        if ($divisor > 0) {
            return $divisor > $dividendo ? 0 : $this->somar(1, $this->dividir($this->subtrair($dividendo, $divisor), $divisor));
        } elseif ($divisor < 0) {
            return - $this->dividir($dividendo, abs($divisor));
        } else {
            throw new \InvalidArgumentException('Divisor nao pode ser zero');
        }
    }

    public function potencia($base, $expoente = 2)
    {
        if ($expoente <= 0) {
            return 0;
        }
        return $expoente == 1 ? $base : $this->multiplicar($base, $this->potencia($base, $this->subtrair($expoente, 1)));
    }

    public function raizQuadrada($numero)
    {
        if ($numero < 0) {
            throw new \InvalidArgumentException('Numero nao pode ser negativo');
        } elseif ($numero == 0) {
            return 0;
        } elseif ($numero == 1) {
            return 1;
        } else {
            return $this->testarRaiz($numero - 1, $numero);
        }
    }

    private function testarRaiz($base, $numero)
    {
        if ($base == 1) {
            return 1;
        }
        if ($this->potencia($base, 2) <= $numero) {
            return $base;
        }
        return $this->testarRaiz($base - 1, $numero);
    }
}
