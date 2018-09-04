<?php

use Dcg\Client\MembershipNumberState\Client;

use Dcg\Client\MembershipNumberState\Utils\API;
use GuzzleHttp\Message\Response;
use GuzzleHttp\Stream\Stream;
use GuzzleHttp\Subscriber\Mock;
use PHPUnit\Framework\TestCase;
use Dcg\Client\MembershipNumberState\Config;

class ClientTest extends TestCase
{
    protected $prodConfig = null;
    protected $testConfig = null;


    public function setUp()
    {
        parent::setUp();

        $this->prodConfig = Config::getInstance(__DIR__.'/../../config.php');
        $this->testConfig = Config::getInstance(__DIR__.'/../../config.php', \Dcg\Config::ENV_TEST);
    }

    public function testClientActivateCallSingleIsOk()
    {
        $mock = new Mock([
            new Response(200, [], Stream::factory(json_encode(['OK'])))
        ]);

        $client = new \GuzzleHttp\Client();

        $client->getEmitter()->attach($mock);

        Api::setClient($client);

        $client = new Client($this->testConfig);
        $data = [['membershipNumber'=>'1234abc1234','expiryDate'=>'2018-01-01 23:59:59']];
        $this->assertTrue($client->activate($data));
    }

    public function testClientActivateCallManyIsOk()
    {
        $mock = new Mock([
            new Response(200, [], Stream::factory(json_encode(['OK'])))
        ]);

        $client = new \GuzzleHttp\Client();

        $client->getEmitter()->attach($mock);

        Api::setClient($client);

        $client = new Client($this->testConfig);
        $data = [
            ['membershipNumber'=>'1234abc1234','expiryDate'=>'2018-01-01 23:59:59'],
            ['membershipNumber'=>'1234abc1234','expiryDate'=>'2018-01-02 23:59:59'],
        ];
        $this->assertTrue($client->activate($data));
    }

    public function testClientActivateCallIsNotOk()
    {
        $mock = new Mock([
            new Response(404, [], Stream::factory(json_encode(['Error'])))
        ]);

        $client = new \GuzzleHttp\Client();

        $client->getEmitter()->attach($mock);

        Api::setClient($client);

        $client = new Client($this->testConfig);
        $data = [
            ['membershipNumber'=>'1234abc1234','expiryDate'=>'2018-01-01 23:59:59'],
            ['membershipNumber'=>'1234abc1234','expiryDate'=>'2018-01-02 23:59:59'],
        ];
        $this->assertFalse($client->activate($data));
    }

    public function testClientUsesDefaultHeader()
    {
        $client = new Client($this->testConfig);
        $headers = $client->getHeaders();
        $this->assertArrayHasKey('Access-Token', $headers);
        $this->assertEquals($headers['Access-Token'], 'TEST_TOKEN');
    }

    public function testClientUsesSetHeader()
    {
        $client = new Client($this->testConfig);
        $client->setHeaders(['Access-Token' => 'test']);
        $headers = $client->getHeaders();
        $this->assertEquals($headers['Access-Token'], 'test');
    }


    public function testTestConfig() {
        $client = new Client($this->testConfig);
        $headers = $client->getHeaders();
        $this->assertEquals($headers['Access-Token'], 'TEST_TOKEN');
    }

    public function testProdConfig() {
        $client = new Client($this->prodConfig);
        $headers = $client->getHeaders();
        $this->assertEquals($headers['Access-Token'], 'PROD_TOKEN');
    }

}