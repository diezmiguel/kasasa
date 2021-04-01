<?php

namespace Tests\Unit;

use App\Utils\Calculator;
use PHPUnit\Framework\TestCase;
use stdClass;

class CalculatorTest extends TestCase
{
    /**
     * @var \APP\Utils\Calculator
     */
    protected $calculator;

    public function Setup(): void
    {
        parent::setUp();
        $this->calculator = new Calculator();
    }

    public function test_calculate_apr()
    {
        $request = new stdClass();
        $request->type = 'auto';
        $request->loan_amount = 525;
        $request->rate = 5.0;
        $request->term = 175;
        $res = $this->calculator->Apr($request);
        $this->assertIsFloat($res);
    }

    public function test_calculate_quotient()
    {
        $quotient = $this->invokeMethod($this->calculator, 'getQuotient', [500, 5, 150]);
        $this->assertIsInt($quotient);
    }

    public function test_calculate_interest()
    {
        $interest = $this->invokeMethod($this->calculator, 'getInterest', [5000, 5, 365]);
        $this->assertIsFloat($interest);
    }

    public function invokeMethod(&$object, $methodName, array $parameters = [])
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }
}
