<?php

declare(strict_types=1);

namespace App\ApiClient\Shared;


use App\ApiClient\Method\Post\PostsRequest;

trait HasSlToken
{
    /**
     * @param string $slToken
     * @return PostsRequest
     */
    public function setSlToken(string $slToken): PostsRequest
    {
        return $this->setParameter('sl_token', $slToken);
    }
}
