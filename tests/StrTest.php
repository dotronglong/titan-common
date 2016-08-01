<?php namespace Titan\Tests\Common;

use Titan\Common\Str;

class StrTest extends TestCase
{
    public function testUpperCaseFirst()
    {
        $this->assertEquals('X-Powered-By', Str::upperCaseFirst('x-Powered-by', '-'));
        $this->assertEquals('X_Powered_By', Str::upperCaseFirst('X_Powered_by', '_'));
        $this->assertEquals('X_Powered-by', Str::upperCaseFirst('X_powered-by', '_'));
    }

    public function testLowerCaseFirst()
    {
        $this->assertEquals('x-powered-by', Str::lowerCaseFirst('X-Powered-by', '-'));
        $this->assertEquals('x_powered_by', Str::lowerCaseFirst('X_Powered_by', '_'));
        $this->assertEquals('x_powered-by', Str::lowerCaseFirst('X_powered-by', '_'));
    }
}