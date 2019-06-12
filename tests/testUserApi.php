<?php
namespace MercierCorentin\Nextcloud\Test;

use MercierCorentin\Nextcloud\User\UserApi;

class MyPackageFunctionTest extends TestCase
{
    /**
     * Check that the multiply method returns correct result
     * @return void
     */
    public function testMultiplyReturnsCorrectValue()
    {
        $this->assertSame(MyPackage::multiply(4, 4), 16);
        $this->assertSame(MyPackage::multiply(2, 9), 18);
    }
}