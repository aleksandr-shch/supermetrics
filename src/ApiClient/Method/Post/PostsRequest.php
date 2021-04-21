<?php

declare(strict_types=1);

namespace App\ApiClient\Method\Post;


use App\ApiClient\Request;
use App\ApiClient\Shared\HasSlToken;

class PostsRequest extends Request
{
    use HasSlToken;

    /**
     * PostsRequest constructor.
     * @param string $slToken
     * @param int $page
     */
    public function __construct(string $slToken, int $page = 1)
    {
        $this->setSlToken($slToken)->setPage($page);
    }

    /**
     * Set current posts page
     *
     * @param int $page
     * @return $this
     */
    public function setPage(int $page): self
    {
        return $this->setParameter('page', $page);
    }
}
