<?php

declare(strict_types=1);

namespace App\ApiClient;


abstract class Request
{
    /**
     * @var array
     */
    protected array $parameters = [];

    /**
     * @param string $key
     * @param $value
     * @return $this
     */
    protected function setParameter(string $key, $value): self
    {
        $this->parameters[$key] = $value;
        return $this;
    }

    /**
     * @return array
     */
    public function parameters(): array
    {
        return $this->parameters;
    }
}
