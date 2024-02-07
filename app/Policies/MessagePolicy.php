<?php

namespace App\Policies;


class MessagePolicy
{
    protected array $permissions;

    public function __construct()
    {
        $this->permissions = auth()->guard('api')->user()->permissions ?? [];
    }

    public function readAdminMessages(): bool
    {
        return in_array('read:admin-messages', $this->permissions);
    }
}
