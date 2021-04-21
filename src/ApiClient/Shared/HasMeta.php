<?php

declare(strict_types=1);

namespace App\ApiClient\Shared;


use App\ApiClient\Shared\Entity\Meta;

trait HasMeta
{
    /**
     * @var Meta|null
     */
    private ?Meta $meta = null;

    /**
     * @return Meta|null
     */
    public function meta(): ?Meta
    {
        return $this->meta;
    }
}
