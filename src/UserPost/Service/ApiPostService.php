<?php

declare(strict_types=1);

namespace App\UserPost\Service;


use App\ApiClient\Method\Post\Entity\Post;
use App\ApiClient\RequestBuilder;
use App\ApiClient\SuperMetricsApiClient;
use App\UserPost\PostsAnalyticsInterface;
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
     * @var array
     */
    private array $analytics = [];

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
     * @param PostsAnalyticsInterface $postsAnalytics
     */
    public function addAnalytics(PostsAnalyticsInterface $postsAnalytics): void
    {
        $this->analytics[] = $postsAnalytics;
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
            throw new Exception(
                json_encode(
                    ["success" => false, "message" => "Register failed {$registerResponse->error()->description()}"]
                )
            );
        }

        return $registerResponse->data()->slToken();
    }

    /**
     * @param $token
     * @return Post
     * @throws GuzzleException
     */
    public function getPosts($token): Post
    {
        $post = new Post();

        foreach (range(1, $this->config['pages']['limit']) as $page) {
            foreach (
                $this->api->posts(RequestBuilder::create()->postsRequest($token, $page))->data()->getPosts(
                ) as $key => $postData
            ) {
                $post->addPost($postData);
            }
        }

        return $post;
    }


    /**
     * @param Post $post
     * @return bool|string
     */
    public function getTotalAnalytics(Post $post): bool|string
    {
        $result = [];

        $this->addAnalytics(new AverageCharacterLengthPostsPerMonthService());
        $this->addAnalytics(new AverageNumberPostsPerUserPerMonthService());
        $this->addAnalytics(new LongestPostCharacterLengthPerMonthService());
        $this->addAnalytics(new TotalPostsSplitWeekNumberService());

        foreach ($this->analytics as $analytic) {
            $result[] = $analytic->getAnalytics($post);
        }

        return json_encode($result);
    }
}