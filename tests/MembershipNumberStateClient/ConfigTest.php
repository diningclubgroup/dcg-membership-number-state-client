<?php

use \Dcg\Client\MembershipNumberState\Config\Config;
use PHPUnit\Framework\TestCase;


class ConfigTest extends TestCase
{

    public function testConfigLoadsSpecificFile()
    {
        $config = Config::getInstance(__DIR__.'/../../config.php');
        $this->assertNotEmpty($config->getConfigValues());
    }

    public function testConfigLoads()
    {
        $config = Config::getInstance();
        $this->assertNotEmpty($config->getConfigValues());
    }

    public function testConfigReturnsValue()
    {
        $config = Config::getInstance();
        $this->assertNotEmpty($config->get('api_base_url'));
    }

}