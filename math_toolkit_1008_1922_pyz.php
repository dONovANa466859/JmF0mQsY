<?php
// 代码生成时间: 2025-10-08 19:22:41
class MathToolkit extends \base
{
    /**
     * Adds two numbers.
     *
     * @param float $a
     * @param float $b
     * @return float
     */
    public function add($a, $b)
    {
        return $a + $b;
    }

    /**
     * Subtracts two numbers.
     *
     * @param float $a
     * @param float $b
     * @return float
     */
    public function subtract($a, $b)
    {
        return $a - $b;
    }

    /**
     * Multiplies two numbers.
     *
     * @param float $a
     * @param float $b
     * @return float
     */
    public function multiply($a, $b)
    {
        return $a * $b;
    }

    /**
     * Divides two numbers.
     *
     * @param float $a
     * @param float $b
     * @return float
     * @throws Exception if divisor is zero
     */
    public function divide($a, $b)
    {
        if ($b == 0) {
            throw new \Exception('Division by zero is not allowed.');
        }
        return $a / $b;
    }

    /**
     * Calculates the power of a number.
     *
     * @param float $base
     * @param float $exponent
     * @return float
     */
    public function power($base, $exponent)
    {
        return pow($base, $exponent);
    }

    /**
     * Calculates the square root of a number.
     *
     * @param float $number
     * @return float
     * @throws Exception if number is negative
     */
    public function squareRoot($number)
    {
        if ($number < 0) {
            throw new \Exception('Square root of a negative number is not real.');
        }
        return sqrt($number);
    }
}
