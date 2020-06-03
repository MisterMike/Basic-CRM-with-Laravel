<?php

namespace App\Policies;

use App\Membership;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class MembershipPolicy
{
    use HandlesAuthorization;

    /**
     * @param $user
     * @param $ability
     * @return bool
     */
    public function before(User $user, $ability)
    {
        if ($user->isAdministrator()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any memberships.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the membership.
     *
     * @param User $user
     * @param Membership $membership
     * @return mixed
     */
    public function view(User $user, Membership $membership)
    {
        //
    }

    /**
     * Determine whether the user can create memberships.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the membership.
     *
     * @param User $user
     * @param Membership $membership
     * @return mixed
     */
    public function update(User $user, Membership $membership)
    {
        $userMemberships = $user->memberships()->pluck('memberships.id');

        return $userMemberships->contains($membership->id)
            ? Response::allow() : Response::deny('You do not have permission to update this membership.');
    }

    /**
     * Determine whether the user can delete the membership.
     *
     * @param User $user
     * @param Membership $membership
     * @return mixed
     */
    public function delete(User $user, Membership $membership)
    {
        $userMemberships = $user->memberships()->pluck('memberships.id');

        return $userMemberships->contains($membership->id)
            ? Response::allow() : Response::deny('You do not have permission to delete this membership.');
    }

    /**
     * Determine whether the user can restore the membership.
     *
     * @param User $user
     * @param Membership $membership
     * @return mixed
     */
    public function restore(User $user, Membership $membership)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the membership.
     *
     * @param User $user
     * @param Membership $membership
     * @return mixed
     */
    public function forceDelete(User $user, Membership $membership)
    {
        //
    }
}
