<?php

declare(strict_types=1);

namespace App\ApiClient\Method\Post\Entity;

use DateTime;
use JMS\Serializer\Annotation\Type;

class Post
{
    /**
     * @var array
     */
    private array $posts = [];

    /**
     * @var string|null
     */
    private ?string $id = null;

    /**
     * @var string|null
     */
    private ?string $fromName = null;

    /**
     * @var string|null
     */
    private ?string $fromId = null;

    /**
     * @var string|null
     */
    private ?string $message = null;

    /**
     * @var string|null
     */
    private ?string $type = null;

    /**
     * @var DateTime
     * @Type("DateTime<'Y-m-d\TH:i:s+P'>")
     */
    private DateTime $createdTime;

    /**
     * @return string|null
     */
    public function getFromName(): ?string
    {
        return $this->fromName;
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * @return DateTime
     */
    public function getCreatedTime(): DateTime
    {
        return $this->createdTime;
    }

    /**
     * @param $post
     */
    public function addPost($post): void
    {
        $this->posts[] = $post;
    }

    /**
     * @return array
     */
    public function getPosts(): array
    {
        return $this->posts;
    }
}
