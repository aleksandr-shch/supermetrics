<?php

declare(strict_types=1);

namespace App\ApiClient\Method\Register\Entity;


class Data
{
    /**
     * @var string|null
     */
    private ?string $clientId = null;

    /**
     * @var string|null
     */
    private ?string $email = null;

    /**
     * @var string|null
     */
    private ?string $slToken = null;

    /**
     * @return string|null
     */
    public function clientId(): ?string
    {
        return $this->clientId;
    }

    /**
     * @return string|null
     */
    public function email(): ?string
    {
        return $this->email;
    }

    /**
     * @return string|null
     */
    public function slToken(): ?string
    {
        return $this->slToken;
    }


}
