<?php

use Dcg\Client\MembershipNumberState\Client;

use Dcg\Client\MembershipNumberState\Utils\API;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    public function testClientInitialisedCorrectly()
    {
        $client = new Client();

        //Dummy test
        $this->assertInstanceOf(Client::class, $client);
    }


    public function testClientActivateCallSingleIsOk()
    {
        $mockHandler = new \GuzzleHttp\Handler\MockHandler([
            new \GuzzleHttp\Psr7\Response(200, [], json_encode(['OK']))
        ]);
        $handler = \GuzzleHttp\HandlerStack::create($mockHandler);

        Api::setClient(new \GuzzleHttp\Client(['handler' => $handler]));

        $client = new Client();
        $data = [['membershipNumber'=>'1234abc1234','expiryDate'=>'2018-01-01 23:59:59']];
        $this->assertTrue($client->activate($data));
    }

    public function testClientActivateCallManyIsOk()
    {
        $mockHandler = new \GuzzleHttp\Handler\MockHandler([
            new \GuzzleHttp\Psr7\Response(200, [], json_encode(['OK']))
        ]);
        $handler = \GuzzleHttp\HandlerStack::create($mockHandler);

        Api::setClient(new \GuzzleHttp\Client(['handler' => $handler]));

        $client = new Client();
        $data = [
            ['membershipNumber'=>'1234abc1234','expiryDate'=>'2018-01-01 23:59:59'],
            ['membershipNumber'=>'1234abc1234','expiryDate'=>'2018-01-02 23:59:59'],
        ];
        $this->assertTrue($client->activate($data));
    }

    public function testClientActivateCallIsNotOk()
    {
        $mockHandler = new \GuzzleHttp\Handler\MockHandler([
            new \GuzzleHttp\Psr7\Response(404, [], json_encode(['Error']))
        ]);
        $handler = \GuzzleHttp\HandlerStack::create($mockHandler);

        Api::setClient(new \GuzzleHttp\Client(['handler' => $handler]));

        $client = new Client();
        $data = [
            ['membershipNumber'=>'1234abc1234','expiryDate'=>'2018-01-01 23:59:59'],
            ['membershipNumber'=>'1234abc1234','expiryDate'=>'2018-01-02 23:59:59'],
        ];
        $this->assertFalse($client->activate($data));
    }

}