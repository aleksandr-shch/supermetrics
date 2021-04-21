<?php

declare(strict_types=1);

namespace App\ApiClient\Method\Register;


use App\ApiClient\Request;

class RegisterRequest extends Request
{
    /**
     * RegisterRequest constructor.
     *
     * @param string $clientId
     * @param string $email
     * @param string $name
     */
    public function __construct(string $clientId, string $email, string $name)
    {
        $this->setClientId($clientId)->setEmail($email)->setName($name);
    }

    /**
     * @param string $clientId
     * @return $this
     */
    public function setClientId(string $clientId): self
    {
        return $this->setParameter('client_id', $clientId);
    }

    /**
     * @param string $email
     * @return $this
     */
    public function setEmail(string $email): self
    {
        return $this->setParameter('email', $email);
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        return $this->setParameter('name', $name);
    }
}
