<?php

declare(strict_types=1);

namespace App\ApiClient\Method\Post;


use App\ApiClient\Method\Post\Entity\Data;

class PostsResponse
{
    /**
     * @var Data|null
     */
    private ?Data $data = null;

    /**
     * @return Data|null
     */
    public function data(): ?Data
    {
        return $this->data;
    }
}
