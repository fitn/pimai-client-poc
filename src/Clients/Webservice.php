<?php

declare(strict_types=1);

namespace Akeneo\PimAi\ApiClient\Clients;

use Akeneo\PimAi\ApiClient\Client;
use Akeneo\PimAi\ApiClient\UriGenerator;
use Akeneo\PimAi\ApiClient\ValueObjects\ApiResponse;
use GuzzleHttp\ClientInterface;

class Webservice implements Client
{
    private
        $uriGenerator,
        $httpClient;

    public function __construct(UriGenerator $uriGenerator, ClientInterface $httpClient)
    {
        $this->uriGenerator = $uriGenerator;
        $this->httpClient = $httpClient;
    }

    public function getResource(string $uri, array $uriParameters): ApiResponse
    {
        $route = $this->uriGenerator->generate($uri, $uriParameters);

        $response = $this->httpClient->request('GET', $route);

        return new ApiResponse(
            $response->getStatusCode(),
            json_decode($response->getBody()->getContents(), true)
        );
    }

    public function createResource(string $uri, array $uriParameters = [], array $body = []): ApiResponse
    {
        $route = $this->uriGenerator->generate($uri, $uriParameters);

        $response = $this->httpClient->request('POST', $route, $body);

        return new ApiResponse(
            $response->getStatusCode(),
            json_decode($response->getBody()->getContents(), true)
        );
    }
}
