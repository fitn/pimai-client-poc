<?php

declare(strict_types=1);

namespace Akeneo\PimAi\ApiClient\Api;

use Akeneo\PimAi\ApiClient\Client;
use Akeneo\PimAi\ApiClient\ValueObjects\ApiResponse;
use Akeneo\PimAi\ApiClient\ValueObjects\SubscriptionId;

class Subscription
{
    private
        $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getSubscription(SubscriptionId $subcriptionId): ApiResponse
    {
        return $this->client->getResource('/subscription/%s', [$subcriptionId->value()]);
    }
}
