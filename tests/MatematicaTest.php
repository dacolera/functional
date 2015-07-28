<?php

use Functional\Matematica;

class MatematicaTest extends \PHPUnit_Framework_TestCase
{
    protected $instance;

    public function setUp()
    {
        $this->instance = new Matematica();
    }

    public function getNumbers()
    {
        return array(
            array(12,8),
            array(39,5),
            array(10,4),
            array(11,8),
            array(124,10)
        );
    }

    public function getNumber()
    {
        return array(
            array(12),
            array(9),
            array(4),
            array(244),
            array(8)
        );
    }

    /**
     * @dataProvider getNumbers
     */
    public function test_somar($n1, $n2)
    {
        $this->assertEquals($n1 + $n2, $this->instance->somar($n1, $n2));
    }

    /**
     * @dataProvider getNumbers
     */
    public function test_multiplicar($n1, $n2)
    {
        $this->assertEquals($n1 * $n2, $this->instance->multiplicar($n1, $n2));
    }

    /**
     * @dataProvider getNumbers
     */
    public function test_subtracao($n1, $n2)
    {
        $this->assertEquals($n1 - $n2, $this->instance->subtrair($n1, $n2));
    }

    /**
     * @expectedException        \InvalidArgumentException
     * @expectedExceptionMessage Divisor nao pode ser zero
     */
    public function test_divisao_por_zero()
    {
        $this->instance->dividir(25, 0);
    }

    /**
     * @dataProvider getNumbers
     */
    public function test_divisao($n1, $n2)
    {
        $this->assertEquals(intval($n1 / $n2), $this->instance->dividir($n1, $n2));
    }

    /**
     * @dataProvider getNumber
     */
    public function test_raiz_quadrada($n1)
    {
        $this->assertEquals(intval(sqrt($n1)), $this->instance->raizQuadrada($n1));
    }

    /**
     * @dataProvider getNumber
     */
    public function test_potencia($n1)
    {
        $this->assertEquals(pow($n1, 2), $this->instance->potencia($n1));
    }
}
