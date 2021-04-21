<?php

require_once './vendor/autoload.php';
$config = include('config/config.php');

use App\ApiClient\SuperMetricsApiClientFactory;
use App\UserPost\Service\ApiPostService;
use GuzzleHttp\Exception\GuzzleException;

$api = SuperMetricsApiClientFactory::make($config['url']['base']);
$apiPostService = new ApiPostService($api, $config);

try {
    $token = $apiPostService->getToken();
} catch (GuzzleException | Exception $e) {
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
    exit();
}

try {
   $post = $apiPostService->getPosts($token);
} catch (GuzzleException $e) {
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
    exit();
}
print_r($apiPostService->getTotalAnalytics($post));
