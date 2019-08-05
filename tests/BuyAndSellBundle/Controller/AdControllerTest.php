<?php

namespace Tests\BuyAndSellBundle\Controller;


use BuyAndSellBundle\Entity\Ad;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdControllerTest extends WebTestCase
{
public function testCreate()
{
$ad = new Ad();
$result = $ad->setPrice(20);

// assert that your create func added the numbers correctly!
$this->assertEquals(20, $result);
}
}
