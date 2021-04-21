<?php

declare(strict_types=1);

namespace App\UserPost;

use App\ApiClient\Method\Post\PostsRequest;

interface PostsAnalyticsInterface
{

    /**
     * @param $posts
     * @return mixed
     */
    public function getAnalytics($posts);
}