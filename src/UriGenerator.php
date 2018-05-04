<?php

declare(strict_types=1);

namespace Akeneo\PimAi\ApiClient;

class UriGenerator
{
    protected $baseUri;

    public function __construct($baseUri)
    {
        $this->baseUri = rtrim($baseUri, '/');
    }

    public function generate($path, array $uriParameters = [], array $queryParameters = [])
    {
        $uriParameters = $this->encodeUriParameters($uriParameters);

        $uri = $this->baseUri . '/' . vsprintf(ltrim($path, '/'), $uriParameters);

        $queryParameters = $this->booleanQueryParametersAsString($queryParameters);

        if (!empty($queryParameters)) {
            $uri .= '?' . http_build_query($queryParameters, null, '&', PHP_QUERY_RFC3986);
        }

        return $uri;
    }

    protected function booleanQueryParametersAsString(array $queryParameters)
    {
        return array_map(function ($queryParameters) {
            if (!is_bool($queryParameters)) {
                return $queryParameters;
            }

            return true === $queryParameters ? 'true' : 'false';
        }, $queryParameters);
    }

    protected function encodeUriParameters(array $uriParameters)
    {
        return array_map(function ($uriParameter) {
            $uriParameter = rawurlencode($uriParameter);

            return preg_replace('~\%2F~', '/', $uriParameter);
        }, $uriParameters);
    }
}
