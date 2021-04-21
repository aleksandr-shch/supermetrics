<?php

declare(strict_types=1);

namespace App\UserPost;

interface PostsAnalyticsInterface
{

    /**
     * @param $posts
     * @return mixed
     */
    public function getAnalytics($posts);
}