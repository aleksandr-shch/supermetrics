<?php


namespace App\UserPost\Service;


use App\ApiClient\Method\Post\Entity\Post;
use App\UserPost\PostsAnalyticsInterface;

class TotalPostsSplitWeekNumberService implements PostsAnalyticsInterface
{
    /**
     * @param Post $post
     * @return array
     */
    public function getAnalytics(Post $post): array
    {
        $analytics = [];

        foreach ($post->getPosts() as $data) {
            $year = $data->getCreatedTime()->format("Y");
            $week = $data->getCreatedTime()->format("W");
            $date = $year . '(' . $week . ')';
            $analytics[$date] = (isset($analytics[$date])) ? $analytics[$date] + 1 : 1;
        }

        return [PostsAnalyticsInterface::TOTAL_POST => $analytics];
    }
}