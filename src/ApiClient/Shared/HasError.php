<?php

declare(strict_types=1);

namespace App\ApiClient\Shared;


use App\ApiClient\Shared\Entity\Error;

trait HasError
{
    /**
     * @var Error|null
     */
    private ?Error $error = null;

    /**
     * @return bool
     */
    public function fail(): bool
    {
        return !is_null($this->error);
    }

    /**
     * @return Error|null
     */
    public function error(): ?Error
    {
        return $this->error;
    }
}
