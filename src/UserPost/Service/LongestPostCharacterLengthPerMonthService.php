<?php


namespace App\UserPost\Service;


use App\UserPost\PostsAnalyticsInterface;

class LongestPostCharacterLengthPerMonthService implements PostsAnalyticsInterface
{

    /**
     * @param $posts
     * @return array
     */
    public function getAnalytics($posts): array
    {
        $analytics = [];

        foreach ($posts as $key => $data) {
            $date = $data->getCreatedTime()->format("Y-m");
            $analytics[$date] = (isset($analytics[$date])) ? max(
                $analytics[$date],
                strlen($data->getMessage())
            ) : strlen($data->getMessage());
        }

        return ['longestPostCharacterLengthPerMonthService' => $analytics];
    }
}