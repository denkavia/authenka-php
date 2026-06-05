<?php

namespace Denkavia\Authenka\Contracts;

use Denkavia\Authenka\DataTransferObjects\UserAuthorizationData;

abstract class AuthenkaDriver
{
    public function hasAnyPermissions(string $user_id, array $permissions, string $client_id): bool
    {
        return $this->checkAny($permissions, $this->getPermissions($user_id, $client_id));
    }

    abstract function checkAny(array $required, array $available): bool;

    public function getPermissions(string $user_id, string $client_id): array
    {
        return $this->getUserAuthorizationData($user_id, $client_id)->getPermissions();
    }

    abstract function getUserAuthorizationData(string $user_id, string $client_id): UserAuthorizationData;

    public function hasAnyRoles(string $user_id, array $roles, string $client_id): bool
    {
        return $this->checkAny($roles, $this->getRoles($user_id, $client_id));
    }

    public function getRoles(string $user_id, string $client_id): array
    {
        return $this->getUserAuthorizationData($user_id, $client_id)->getRoles();
    }

    public function hasRoles(string $user_id, array $roles, string $client_id): bool
    {
        return $this->checkAll($roles, $this->getRoles($user_id, $client_id));
    }

    abstract function checkAll(array $required, array $available): bool;

    public function hasPermissions(string $user_id, array $permissions, string $client_id): bool
    {
        return $this->checkAll($permissions, $this->getPermissions($user_id, $client_id));
    }
}