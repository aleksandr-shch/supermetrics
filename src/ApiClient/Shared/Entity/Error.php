<?php

declare(strict_types=1);

namespace App\ApiClient\Shared\Entity;


class Error
{
    /**
     * @var string|null
     */
    private ?string $code = null;

    /**
     * @var string|null
     */
    private ?string $message = null;

    /**
     * @var string|null
     */
    private ?string $description = null;

    /**
     * @return string|null
     */
    public function code(): ?string
    {
        return $this->code;
    }

    /**
     * @return string|null
     */
    public function message(): ?string
    {
        return $this->message;
    }

    /**
     * @return string|null
     */
    public function description(): ?string
    {
        return $this->description;
    }
}
