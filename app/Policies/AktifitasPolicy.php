<?php

namespace App\Policies;

use App\Models\Aktifita;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AktifitasPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        return ($user->level === 'ADMIN' || $user->level === 'SUPERADMIN');
    }

    public function create(User $user)
    {
        return ($user->level === 'ADMIN' || $user->level === 'SUPERADMIN');
    }

    public function update(User $user)
    {
        return ($user->level === 'ADMIN' || $user->level === 'SUPERADMIN');
    }

    public function delete(User $user)
    {
        return ($user->level === 'ADMIN' || $user->level === 'SUPERADMIN');
    }
}
