<?php


namespace App\UserPost\Service;


use App\ApiClient\Method\Post\Entity\Post;
use App\UserPost\PostsAnalyticsInterface;

class AverageCharacterLengthPostsPerMonthService implements PostsAnalyticsInterface
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
            $analytics[$date][] = strlen($data->getMessage());
        }

        foreach ($analytics as $key => $month) {
            $analytics[$key] = round(array_sum($month) / count($month));
        }

        return [PostsAnalyticsInterface::AVERAGE_CHARACTER => $analytics];
    }
}