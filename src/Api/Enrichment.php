<?php

declare(strict_types=1);

namespace Akeneo\PimAi\ApiClient\Api;

use Akeneo\PimAi\ApiClient\Client;
use Akeneo\PimAi\ApiClient\ValueObjects\ApiResponse;
use Akeneo\PimAi\ApiClient\ValueObjects\Subscription\Request;

class Enrichment
{
    private
        $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function sendSubscriptionRequest(Request $subscriptionRequest): ApiResponse
    {
        return $this->client->createResource('/enrichments', [], $subscriptionRequest->toArray());
    }
}
