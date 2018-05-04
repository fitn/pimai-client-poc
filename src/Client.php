<?php

declare(strict_types=1);

namespace Akeneo\PimAi\ApiClient;

use Akeneo\PimAi\ApiClient\ValueObjects\ApiResponse;

interface Client
{
    public function getResource(string $uri, array $uriParameters): ApiResponse;

    public function createResource(string $uri, array $uriParameters = [], array $body = []): ApiResponse;
}
