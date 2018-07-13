<?php

namespace Dcg\Client\MembershipNumberState;

use Dcg\Client\MembershipNumberState\Utils\Api;
use Dcg\Client\MembershipNumberState\Utils\Dates;

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

    public function deactivate(array $membershipData) /*FIXME  WIP!*/
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

    public function updateExpiryDate(array $membershipData) /*Fixme WIP! */
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
        $membershipNumberStateApiEndpoint = env('MembershipNumberStateUpdateExpiryDateApiEndpoint');
        $requestResponse = Api::sendRequest([],$membershipNumberStateApiEndpoint,'POST',$membershipData);

        return  $requestResponse['successful'];
    }

}