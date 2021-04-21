<?php


namespace App\UserPost\Service;


use App\ApiClient\Method\Post\Entity\Post;
use App\UserPost\PostsAnalyticsInterface;

class LongestPostCharacterLengthPerMonthService implements PostsAnalyticsInterface
{

    /**
     * @param Post $post
     * @return array
     */
    public function getAnalytics(Post $post): array
    {
        $analytics = [];

        foreach ($post->getPosts() as $data) {
            $date = $data->getCreatedTime()->format("Y-m");
            $analytics[$date] = (isset($analytics[$date])) ? max(
                $analytics[$date],
                strlen($data->getMessage())
            ) : strlen($data->getMessage());
        }

        return [PostsAnalyticsInterface::LONGEST_POST => $analytics];
    }
}