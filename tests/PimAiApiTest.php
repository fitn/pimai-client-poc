<?php

declare(strict_types=1);

namespace Akeneo\PimAi\ApiClient\tests;

use Akeneo\PimAi\ApiClient\PimAiApi;
use Akeneo\PimAi\ApiClient\UriGenerator;
use Akeneo\PimAi\ApiClient\Api\Enrichment;
use Akeneo\PimAi\ApiClient\Api\Subscription;
use Akeneo\PimAi\ApiClient\Clients\Memory;
use Akeneo\PimAi\ApiClient\Clients\Webservice;
use Akeneo\PimAi\ApiClient\ValueObjects\Subscription\ProductId;
use Akeneo\PimAi\ApiClient\ValueObjects\Subscription\Request;
use Akeneo\PimAi\ApiClient\ValueObjects\SubscriptionId;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;

class PimAiApiTest extends TestCase
{
    private
        $pimAiApi;

    public function setUp()
    {
        // $client = new Memory(new UriGenerator('http://localhost:8080'));
        // serveur HTTP docker en local pour servir les JSON d'exemple :
        // ~/workspace/pim-ai-api-php-client $ docker run -dit -p 8080:80 -v "$PWD/docs":/usr/local/apache2/htdocs/ httpd:2.4
        $client = new Webservice(new UriGenerator('http://localhost:8080/'), new \GuzzleHttp\Client());
        $enrichmentApi = new Enrichment($client);
        $subscriptionApi = new Subscription($client);

        $this->pimAiApi = new PimAiApi($enrichmentApi, $subscriptionApi);
    }

    public function testSendSubscription()
    {
        $subscriptionRequest = new Request();
        $subscriptionRequest
            ->addProductId(new ProductId('upc', '0043396087002'))
            ->addProductId(new ProductId('asin', 'auisretaurnie'))
            ->addProductId(new ProductId('asin', 'B0778KFZ3X'));

        $response = $this->pimAiApi->getEnrichmentApi()->sendSubscriptionRequest($subscriptionRequest);
        $this->assertSame(Response::HTTP_OK, $response->code());
        $this->assertSame(
            json_decode(file_get_contents(__DIR__ . '/../docs/enrichments'), true),
            $response->content()
        );
    }

    public function testGetSubscription()
    {
        $response = $this->pimAiApi->getSubscriptionApi()->getSubscription(new SubscriptionId('35c1c788-bef2-4024-8366-237145703fef'));

        $this->assertSame(Response::HTTP_OK, $response->code());
        $this->assertSame(
            json_decode(file_get_contents(__DIR__ . '/../docs/subscription/35c1c788-bef2-4024-8366-237145703fef'), true),
            $response->content()
        );
    }
}
