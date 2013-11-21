<?php

namespace Leaphly\Cart\Tests\Provider;

use Leaphly\Cart\Calculator\PriceCalculator;

/**
 *
 * @author Giulio De Donato <liuggio@gmail.com>
 * @package Leaphly\Cart\Tests\Provider
 */
class PriceCalculatorTest extends \PHPUnit_Framework_TestCase
{

    public function testCalculatePrice()
    {
        $price = 5;
        $finalPrice = 4;

        $item = $this->getMock('Leaphly\Cart\Model\ItemInterface');
        $item->expects($this->once())
            ->method('getPrice')
            ->will($this->returnValue($price));
        $item->expects($this->once())
            ->method('getFinalPrice')
            ->will($this->returnValue($finalPrice));

        $cart = $this->getMock('Leaphly\Cart\Model\CartInterface');

        $cart->expects($this->once())
            ->method('getItems')
            ->will($this->returnValue(array($item)));
        $cart->expects($this->once())
            ->method('setPrice')
            ->with($this->equalTo($price));
        $cart->expects($this->once())
            ->method('setFinalPrice')
            ->with($this->equalTo($finalPrice));

        $priceCalculator = new PriceCalculator();
        $priceCalculator->calculatePrice($cart);
    }
}