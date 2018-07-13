<?php

use Dcg\Client\MembershipNumberStateClient\Client;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    public function testClientInitialisedCorrectly()
    {
        $client = new Client();

        //Dummy test
        $this->assertInstanceOf(Client::class, $client);
    }


    public function testClientActivateCallSingleIsOk{
        $client = new Client();
        $data = [['membershipNumber'=>'1234abc1234','expiryDate'=>'2018-01-01 23:59:59']];
        $this->assetTrue($client->activate($data));
    }

    public function testClientActivateCallManyIsOk{
        $client = new Client();
        $data = [
            ['membershipNumber'=>'1234abc1234','expiryDate'=>'2018-01-01 23:59:59'],
            ['membershipNumber'=>'1234abc1234','expiryDate'=>'2018-01-02 23:59:59'],
        ];
        $this->assetTrue($client->activate($data));
    }

}