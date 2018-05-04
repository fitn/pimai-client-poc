<?php

declare(strict_types=1);

namespace Akeneo\PimAi\ApiClient;

use Akeneo\PimAi\ApiClient\Api\Enrichment;
use Akeneo\PimAi\ApiClient\Api\Subscription;

class PimAiApi
{
    private
        $enrichmentApi,
        $subscriptionApi;

    public function __construct(Enrichment $enrichmentApi, Subscription $subscriptionApi)
    {
        $this->enrichmentApi = $enrichmentApi;
        $this->subscriptionApi = $subscriptionApi;
    }

    public function getSubscriptionApi(): Subscription
    {
        return $this->subscriptionApi;
    }

    public function getEnrichmentApi(): Enrichment
    {
        return $this->enrichmentApi;
    }
}
