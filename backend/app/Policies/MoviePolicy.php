<?php

namespace App\Policies;

use App\Models\Movie;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MoviePolicy extends BasePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Movie $movie): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return $this->isAdmin($user)
            ? Response::allow()
            : Response::deny("You must be an administrator to create a movie!");
    }

    public function uploadPoster(User $user): Response
    {
        return $this->isAdmin($user)
            ? Response::allow()
            : Response::deny("You must be an administrator to upload poster!");
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): Response
    {
        return $this->isAdmin($user)
            ? Response::allow()
            : Response::deny("Only the admin can update the movie!");
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Movie $movie): Response
    {
        return $this->isAdmin($user)
            ? Response::allow()
            : Response::deny("You must be an administrator!");
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Movie $movie): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Movie $movie): bool
    {
        //
    }
}
