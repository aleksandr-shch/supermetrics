<?php

declare(strict_types=1);

namespace App\ApiClient;


use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;

class SuperMetricsApiClientFactory
{
    /**
     * @return SerializerInterface
     */
    protected static function makeSerializer(): SerializerInterface
    {
        return SerializerBuilder::create()->build();
    }

    /**
     * @return ClientInterface
     */
    protected static function makeHttpClient(): ClientInterface
    {
        return new Client();
    }

    /**
     * @param string $baseUri
     * @return SuperMetricsApiClient
     */
    public static function make(string $baseUri): SuperMetricsApiClient
    {
        return new SuperMetricsApiClient(
            static::makeHttpClient(),
            static::makeSerializer(),
            $baseUri
        );
    }
}
