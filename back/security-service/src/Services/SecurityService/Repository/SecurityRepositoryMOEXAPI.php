<?php

namespace App\Services\SecurityService\Repository;

use App\Services\SecurityService\UseCases\XmlToDTOConverter;
use Doctrine\Common\Collections\ArrayCollection;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class SecurityRepositoryMOEXAPI implements ISecurityRepository
{
    private string $apiUrl;

    public function __construct(
        private LoggerInterface     $logger,
        private HttpClientInterface $http,
        private XmlToDTOConverter $xmlToDTOConverter
    )
    {
        $this->apiUrl = $_ENV['MOEX_URL'] . '/securities';
    }

    public function getSecurities(string $query): ArrayCollection
    {
        $url = $this->apiUrl . ($query ? '?q=' . $query : '');
        try {
            $this->logger->info("Получение списка ценных бумаг по запросу: \"$query\"");
            $res = $this->http->request('GET', $url);
            return $this->xmlToDTOConverter->convert($res->getContent());
        } catch (\Exception $e) {
            $this->logger->error('При получении списка ценных бумаг возникла ошибка: ' . $e->getMessage());
            throw $e;
        }
    }
}