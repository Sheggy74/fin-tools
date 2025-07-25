<?php

namespace App\Services\LogService;

use DateTime;
use DateTimeZone;
use Symfony\Component\HttpClient\CurlHttpClient;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpClient\NativeHttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class LogService
{
    private HttpClientInterface $httpClient;
    private string $url;
    public function __construct()
    {
        $this->url = 'http://logstash:5044';
        $this->httpClient = new CurlHttpClient();
    }

    public function info($message){
        $this->httpClient->request('POST',$this->url,[
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'body' => json_encode([
                'message' => $message,
                'service' => 'security_service',
                'user' => 'user',
               // 'timestamp' => (new DateTime('now', new DateTimeZone('UTC')))->format('Y-m-d\TH:i:s\Z')
            ])
        ]);
    }
}