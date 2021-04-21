<?php

declare(strict_types=1);

namespace App\UserPost\Service;


use App\ApiClient\RequestBuilder;
use App\ApiClient\SuperMetricsApiClient;
use Exception;
use GuzzleHttp\Exception\GuzzleException;

class ApiPostService
{
    /**
     * @var SuperMetricsApiClient
     */
    private SuperMetricsApiClient $api;

    /**
     * @var array
     */
    private array $config;

    /**
     * ApiPostService constructor.
     * @param SuperMetricsApiClient $api
     * @param array $config
     */
    public function __construct(SuperMetricsApiClient $api, array $config)
    {
        $this->config = $config;
        $this->api = $api;
    }

    /**
     * @return string|null
     * @throws GuzzleException
     * @throws Exception
     */
    public function getToken(): ?string
    {
        $registerRequest = RequestBuilder::create()->registerRequest(
            $this->config['client']['id'],
            $this->config['client']['email'],
            $this->config['client']['name']
        );

        $registerResponse = $this->api->register($registerRequest);

        if ($registerResponse->fail()) {
            throw new Exception(json_encode(
                ["success" => false, "message" => "Register failed {$registerResponse->error()->description()}"]
            ));
        }

        return $registerResponse->data()->slToken();
    }

    /**
     * @param $token
     * @return array
     * @throws GuzzleException
     */
    public function getPosts($token): array
    {
        $posts = [];

        foreach (range(1, $this->config['pages']['limit']) as $page) {
            foreach (
                $this->api->posts(RequestBuilder::create()->postsRequest($token, $page))->data()->getPosts(
                ) as $key => $post
            ) {
                $posts[] = $post;
            }
        }

        return $posts;
    }

    /**
     * @param $posts
     * @return string
     */
    public function getAnalytics($posts): string
    {
        $averageCharacterLengthPostsPerMonthService = new AverageCharacterLengthPostsPerMonthService();
        $averageNumberPostsPerUserPerMonthService = new AverageNumberPostsPerUserPerMonthService();
        $longestPostCharacterLengthPerMonthService = new LongestPostCharacterLengthPerMonthService();
        $totalPostsSplitWeekNumberService = new TotalPostsSplitWeekNumberService();

        return json_encode([$averageCharacterLengthPostsPerMonthService->getAnalytics($posts),
        $averageNumberPostsPerUserPerMonthService->getAnalytics($posts),
        $longestPostCharacterLengthPerMonthService->getAnalytics($posts),
        $totalPostsSplitWeekNumberService->getAnalytics($posts)]);
    }
}