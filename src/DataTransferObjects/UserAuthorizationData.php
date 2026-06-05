<?php

namespace Denkavia\Authenka\DataTransferObjects;

use Denkavia\Authenka\Exceptions\InvalidArgumentException;

final readonly class UserAuthorizationData
{
    public function __construct(
        protected array $roles,
        protected array $permissions,
    )
    {
    }

    /**
     * @throws InvalidArgumentException
     */
    static function fromArray(array $data): self
    {
        if (
            !isset($data['roles']) ||
            !is_array($data['roles']) ||
            !isset($data['permissions']) ||
            !is_array($data['permissions'])
        ) {
            throw new InvalidArgumentException("Invalid data format for user authorization data");
        }

        return new self($data['roles'], $data['permissions']);
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function getPermissions(): array
    {
        return $this->permissions;
    }
}