<?php

namespace Dcg\Client\MembershipNumberStateClient;

use Dcg\Client\MembershipNumberStateClient\Utils\Api;
use Dcg\Client\MembershipNumberStateClient\Utils\Dates;

class Client
{
    public function activate(array $membershipData)
    {
        /* we are expecting data in the format:
        [ ['membershipNumber' => 'xx', 'expiryDate'=>'Y-m-d H:i:s']]
        */
        foreach($membershipData as $i=>$data){
            if(!isset($data['membershipNumber']) || !isset($data['expiryDate'])){
                if(!Dates::validateDate($data['expiryDate'])){
                    throw new \InvalidArgumentException("Invalid data provided");
                }
            }
        }
        $membershipNumberStateApiEndpoint = env('MembershipNumberStateActivateApiEndpoint');
        $requestResponse = Api::sendRequest([],$membershipNumberStateApiEndpoint,'POST',$membershipData);

        return  $requestResponse['successful'];
    }

    public function deactivate(array $membershipData)
    {
        /* we are expecting data in the format:
        [ ['membershipNumber' => 'xx', 'expiryDate'=>'Y-m-d H:i:s']]
        */
        foreach($membershipData as $i=>$data){
            if(!isset($data['membershipNumber']) || !isset($data['expiryDate'])){
                if(!Dates::validateDate($data['expiryDate'])){
                    throw new \InvalidArgumentException("Invalid data provided");
                }
            }
        }
        $membershipNumberStateApiEndpoint = env('MembershipNumberStateDeactivateApiEndpoint');
        $requestResponse = Api::sendRequest([],$membershipNumberStateApiEndpoint,'POST',$membershipData);

        return  $requestResponse['successful'];
    }
}