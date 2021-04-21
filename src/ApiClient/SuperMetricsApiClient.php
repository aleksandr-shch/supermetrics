<?php

declare(strict_types=1);

namespace App\ApiClient;


use App\ApiClient\Method\Post\PostsRequest;
use App\ApiClient\Method\Post\PostsResponse;
use App\ApiClient\Method\Register\RegisterRequest;
use App\ApiClient\Method\Register\RegisterResponse;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerInterface;

class SuperMetricsApiClient
{
    /**
     * @var string
     */
    private string $baseUri;

    /**
     * @var ClientInterface
     */
    private ClientInterface $httpClient;

    /**
     * @var Serializer|SerializerInterface
     */
    private Serializer|SerializerInterface $serializer;

    /**
     * ApiClient constructor.
     * @param ClientInterface $httpClient
     * @param SerializerInterface $serializer
     * @param string $baseUri
     */
    public function __construct(ClientInterface $httpClient, SerializerInterface $serializer, string $baseUri)
    {
        $this->httpClient = $httpClient;
        $this->serializer = $serializer;
        $this->baseUri = $baseUri;
    }

    /**
     * @param string $method
     * @param string $endPoint
     * @param array $requestOptions
     * @param string $responseClass
     * @return mixed
     * @throws GuzzleException
     */
    protected function sendRequest(
        string $method,
        string $endPoint,
        array $requestOptions,
        string $responseClass
    ): mixed {
        $requestOptions = array_merge(
            [
                'base_uri' => $this->baseUri,
                'http_errors' => false,
            ],
            $requestOptions
        );
        $response = $this->httpClient->request($method, $endPoint, $requestOptions);
        $body = $response->getBody()->getContents();

        return $this->deserializeResponseBody($body, $responseClass);
    }

    /**
     * @param string $responseBody
     * @param string $responseClass
     * @return mixed
     */
    protected function deserializeResponseBody(string $responseBody, string $responseClass): mixed
    {
        return $this->serializer->deserialize($responseBody, $responseClass, 'json');
    }

    /**
     * @param $endPoint
     * @param Request $request
     * @param string $responseClass
     * @return mixed
     * @throws GuzzleException
     */
    protected function sendGetRequest($endPoint, Request $request, string $responseClass): mixed
    {
        return $this->sendRequest(
            'get',
            $endPoint,
            ['query' => $request->parameters(),],
            $responseClass
        );
    }

    /**
     * @param $endPoint
     * @param Request $request
     * @param string $responseClass
     * @return mixed
     * @throws GuzzleException
     */
    protected function sendPostRequest($endPoint, Request $request, string $responseClass): mixed
    {
        return $this->sendRequest(
            'post',
            $endPoint,
            ['form_params' => $request->parameters(),],
            $responseClass
        );
    }

    /**
     * @param RegisterRequest $request
     * @return RegisterResponse
     * @throws GuzzleException
     */
    public function register(RegisterRequest $request): RegisterResponse
    {
        return $this->sendPostRequest('register', $request, RegisterResponse::class);
    }

    /**
     * @param PostsRequest $request
     * @return PostsResponse
     * @throws GuzzleException
     */
    public function posts(PostsRequest $request): PostsResponse
    {
        return $this->sendGetRequest('posts', $request, PostsResponse::class);
    }
}
