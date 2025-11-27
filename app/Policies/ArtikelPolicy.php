<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Artikel;

class ArtikelPolicy
{
    public function update(User $user, Artikel $artikel)
    {
        return $user->isAdmin() || $user->id_user === $artikel->id_user;
    }

    public function delete(User $user, Artikel $artikel)
    {
        return $user->isAdmin() || $user->id_user === $artikel->id_user;
    }
}