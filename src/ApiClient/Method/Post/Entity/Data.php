<?php

declare(strict_types=1);

namespace App\ApiClient\Method\Post\Entity;

use JMS\Serializer\Annotation\Type;

class Data
{
    /**
     * @var int|null
     */
    private ?int $page = null;

    /**
     * @Type("array<App\ApiClient\Method\Post\Entity\Post>")
     */
    private array $posts = [];

    /**
     * @return array
     */
    public function getPosts(): array
    {
        return $this->posts;
    }
}
