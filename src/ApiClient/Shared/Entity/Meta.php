<?php

declare(strict_types=1);

namespace App\ApiClient\Shared\Entity;


class Meta
{
    /**
     * @var string|null
     */
    private ?string $requestId = null;

    /**
     * @return string|null
     */
    public function requestId(): ?string
    {
        return $this->requestId;
    }

}
