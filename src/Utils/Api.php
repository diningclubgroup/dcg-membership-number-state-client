<?php

namespace Dcg\Client\MembershipNumberState\Utils;

use GuzzleHttp;
use GuzzleHttp\Client;

class API{

    static public function sendRequest($headers=[], $uri, $requestType,  $payload=[] )
    {
        if (!empty($payload)) {
            if (is_array($payload) || is_object($payload)) {
                // JSON encode all arrays and objects
                $request_payload = json_encode($payload);
            } else {
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

            $statusCode = $e->getCode();

            return ['successful' => self::statusOk($statusCode),
                'statusCode' => $statusCode,
                'responseBody' => $e->getMessage()
            ];
        }

        $statusCode = $requestResponse->getStatusCode();

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
