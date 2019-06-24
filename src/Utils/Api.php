<?php

namespace Dcg\Client\MembershipNumberState\Utils;

use GuzzleHttp;
use GuzzleHttp\Psr7\Request;

class API
{

    private static $client;

    static public function sendRequest($headers, $uri, $requestType, $payload = [])
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

        $apiClient = self::getClient();

        $attempt = 0;
        $tries = 3;
        $lastException = null;

        do {
            try {
                $request = new Request($requestType, $uri, $headers, $payload);
                $requestResponse = $apiClient->send($request);

                $statusCode = $requestResponse->getStatusCode();

                return ['successful' => self::statusOk($statusCode),
                    'statusCode' => $statusCode,
                    'responseBody' => $requestResponse->getBody()
                ];

            } catch (GuzzleHttp\Exception\ClientException $e) {
                $lastException = $e;
                break;
            } catch (\Exception $e) {
                $lastException = $e;
            }

            $attempt++;

        } while ($attempt < $tries);


        $statusCode = $lastException->getCode();

        return ['successful' => self::statusOk($statusCode),
            'statusCode' => $statusCode,
            'responseBody' => $lastException->getMessage()
        ];

    }

    static private function getClient()
    {
        if (empty(self::$client)) {
            self::$client = new GuzzleHttp\Client();
        }

        return self::$client;
    }

    static private function statusOk($statusCode)
    {
        return ($statusCode >= 200 and $statusCode < 300) ? true : false;
    }

    static public function setClient(GuzzleHttp\Client $client)
    {
        self::$client = $client;
    }
}
