<?php

namespace Dcg\Client\MembershipNumberState;

use Dcg\Client\MembershipNumberState\Config\Config;
use Dcg\Client\MembershipNumberState\Utils\Api;
use Dcg\Client\MembershipNumberState\Utils\Dates;


class Client
{

	/**
	 * @var Config
	 */
	protected $config;

	public function __construct()
	{
		$this->config = Config::getInstance();
	}

	private function getEndPoint($endPointName)
	{
        $baseUrl = $this->config->get('api_base_url');

        switch($endPointName){
            case 'MembershipNumberStateActivateApiEndpoint':
                $ep = '/eagle-eye/activate';
                break;
            case 'MembershipNumberStateDeactivateApiEndpoint':
                $epp = '/eagle-eye/deactivate';
                break;
            case 'MembershipNumberStateUpdateExpiryDateApiEndpoint':
                $ep = '/eagle-eye/updateexpirydate';
                break;
            default:
                throw new \Exception("unknown endpoint requested",401);
        }
        return $baseUrl.$ep;
    }

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
        $membershipNumberStateApiEndpoint = $this->getEndpoint('MembershipNumberStateActivateApiEndpoint');
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
        $membershipNumberStateApiEndpoint = $this->getEndPoint('MembershipNumberStateDeactivateApiEndpoint');
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
        $membershipNumberStateApiEndpoint = $this->getEndPoint('MembershipNumberStateUpdateExpiryDateApiEndpoint');
        $requestResponse = Api::sendRequest([],$membershipNumberStateApiEndpoint,'POST',$membershipData);

        return  $requestResponse['successful'];
    }

}