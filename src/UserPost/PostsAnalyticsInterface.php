<?php

declare(strict_types=1);

namespace App\UserPost;

use App\ApiClient\Method\Post\Entity\Post;

interface PostsAnalyticsInterface
{
    public const AVERAGE_CHARACTER = 'averageCharacterLengthPostsPerMonthService';

    public const AVERAGE_NUMBER = 'averageNumberPostsPerUserPerMonthService';

    public const LONGEST_POST = 'longestPostCharacterLengthPerMonthService';

    public const TOTAL_POST = 'totalPostsSplitWeekNumberService';

    /**
     * @param Post $post
     */
    public function getAnalytics(Post $post);
}