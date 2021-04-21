<?php


namespace App\UserPost\Service;


use App\UserPost\PostsAnalyticsInterface;

class TotalPostsSplitWeekNumberService implements PostsAnalyticsInterface
{
    /**
     * @param $posts
     * @return array
     */
    public function getAnalytics($posts): array
    {
        $analytics = [];

        foreach ($posts as $key => $data) {
            $year = $data->getCreatedTime()->format("Y");
            $week = $data->getCreatedTime()->format("W");
            $date = $year . '(' . $week . ')';
            $analytics[$date] = (isset($analytics[$date])) ? $analytics[$date] + 1 : 1;
        }

        return ['totalPostsSplitWeekNumberService' => $analytics];
    }
}