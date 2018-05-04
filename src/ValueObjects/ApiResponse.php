<?php

declare(strict_types=1);

namespace Akeneo\PimAi\ApiClient\ValueObjects;

class ApiResponse
{
    private
        $responseCode,
        $content;

    public function __construct(int $responseCode, ?array $content = [])
    {
        $this->responseCode = $responseCode;
        $this->content = $content;
    }

    public function code(): int
    {
        return $this->responseCode;
    }

    public function content(): ?array
    {
        return $this->content;
    }
}
