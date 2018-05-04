<?php

declare(strict_types=1);

namespace Akeneo\PimAi\ApiClient\ValueObjects\Subscription;

class Request
{
    private
        $productIds;

    public function __construct()
    {
        $this->productIds = [];
    }

    public function addProductId(ProductId $productId): self
    {
        $this->productIds[] = $productId;

        return $this;
    }

    public function toArray()
    {
        $result = [];
        foreach($this->productIds as $productId)
        {
            $result[$productId->identifierName()][] = $productId->value();
        }

        return $result;
    }
}
