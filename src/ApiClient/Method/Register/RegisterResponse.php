<?php

declare(strict_types=1);

namespace App\ApiClient\Method\Register;


use App\ApiClient\Method\Register\Entity\Data;
use App\ApiClient\Shared\HasError;
use App\ApiClient\Shared\HasMeta;

class RegisterResponse
{
    use HasError;
    use HasMeta;

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

    /**
     * @return bool
     */
    public function success(): bool
    {
        return !is_null($this->data());
    }
}
