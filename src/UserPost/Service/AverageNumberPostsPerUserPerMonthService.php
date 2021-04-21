<?php


namespace App\UserPost\Service;


use App\UserPost\PostsAnalyticsInterface;

class AverageNumberPostsPerUserPerMonthService implements PostsAnalyticsInterface
{

    /**
     * @param $posts
     * @return array
     */
    public function getAnalytics($posts): array
    {
        $analytics = [];

        foreach ($posts as $key => $data){
            $date = $data->getCreatedTime()->format("Y-m");
            $user = $data->getFromName();
            $analytics[$date][$user] = (isset( $analytics[$date][$user])) ?  $analytics[$date][$user]+1 : 1;
        }

        foreach ($analytics as $key => $month){
            $analytics[$key] = round(array_sum($month)/count($month));
        }

        return ['averageNumberPostsPerUserPerMonthService' => $analytics];
    }
}