<?php

namespace App\Services\ReferenceService\Repository;

use App\Services\ReferenceService\DTO\CommonReferenceDTO;
use App\Services\ReferenceService\UseCases\XmlToDTOConverter;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ReferenceRepositoryMOEXAPI implements IReferenceRepository
{
    private string $apiUrl;

    /**
     * @param string $apiUrl
     */
    public function __construct(
        private LoggerInterface     $logger,
        private HttpClientInterface $http,
        private XmlToDTOConverter $xmlToDTOConverter,
    )
    {
        $this->apiUrl = $_ENV['MOEX_URL'] . '/index';
    }


    public function getReference(): CommonReferenceDTO
    {
        try {
            $res = $this->http->request('GET', $this->apiUrl);
            return $this->xmlToDTOConverter->convert($res->getContent());
        } catch (\Exception $e) {
            $this->logger->error('При получении глобальных справочников возникла ошибка: ' . $e->getMessage());
            throw $e;
        }

    }
}