<?php


namespace App\UserPost\Service;


use App\UserPost\PostsAnalyticsInterface;

class AverageCharacterLengthPostsPerMonthService implements PostsAnalyticsInterface
{
    /**
     * @param array $posts
     * @return array
     */
    public function getAnalytics($posts): array
    {
        $analytics = [];

        foreach($posts as $key => $data){
            $date = $data->getCreatedTime()->format("Y-m");
            $analytics[$date][] = strlen($data->getMessage());
        }

        foreach ($analytics as $key => $month){
            $analytics[$key] = round(array_sum($month)/count($month));
        }

        return ['averageCharacterLengthPostsPerMonthService' => $analytics];
    }
}