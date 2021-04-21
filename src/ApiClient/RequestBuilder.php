<?php

declare(strict_types=1);

namespace App\ApiClient;


use App\ApiClient\Method\Post\PostsRequest;
use App\ApiClient\Method\Register\RegisterRequest;

class RequestBuilder
{
    /**
     * @return static
     */
    public static function create(): self
    {
        return new static();
    }

    /**
     * @param string $clientId
     * @param string $email
     * @param string $name
     * @return RegisterRequest
     */
    public function registerRequest(string $clientId, string $email, string $name): RegisterRequest
    {
        return new RegisterRequest($clientId, $email, $name);
    }

    /**
     * @param string $slToken
     * @param int $page
     * @return PostsRequest
     */
    public function postsRequest(string $slToken, int $page = 1): PostsRequest
    {
        return new PostsRequest($slToken, $page);
    }
}
