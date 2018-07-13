<?php

namespace Dcg\Client\MembershipNumberState\Utils;

use GuzzleHttp;
use GuzzleHttp\Client;
use Log;

class API{

    static public function sendRequest($headers=[], $uri, $requestType,  $payload=[] )
    {
        Log::debug(print_r($headers,true));


        if (!empty($payload)) {
            if (is_array($payload) || is_object($payload)) {
                Log::debug("converting to json");
                // JSON encode all arrays and objects
                $request_payload = json_encode($payload);
            } else {
                Log::debug("not converting to json");
                // Use the payload as-is
                $request_payload = $payload;
            }
            $payload = $request_payload;
        }

        $request = new Client();
        $apiPayload = [
                'headers' => $headers,
                'body'    => $payload
            ];

        try{

            $requestResponse = $request->request($requestType, $uri, $apiPayload);

        }catch(GuzzleHttp\Exception\TransferException $e){

            Log::error("catch:".$e->getMessage().$e->getCode());

            $statusCode = $e->getCode();

            return ['successful' => self::statusOk($statusCode),
                'statusCode' => $statusCode,
                'responseBody' => $e->getMessage()
            ];
        }

        $statusCode = $requestResponse->getStatusCode();

        Log::debug($requestResponse->getBody());

        return ['successful' => self::statusOk($statusCode),
            'statusCode' => $statusCode,
            'responseBody' => $requestResponse->getBody()
            ];
    }

    static private function statusOk($statusCode)
    {
        return ($statusCode >= 200 and $statusCode < 300)? true :false;
    }
}
