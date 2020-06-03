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
     * Determine whether the user can view any companies.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the company.
     *
     * @param User $user
     * @param Company $company
     * @return mixed
     */
    public function view(User $user, Company $company)
    {
        //
    }

    /**
     * Determine whether the user can create companies.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the company.
     *
     * @param User $user
     * @param Company $company
     * @return mixed
     */
    public function update(User $user, Company $company)
    {
        $userMemberships = $user->memberships()->pluck('companies.id');

        return $userMemberships->contains($company->id)
            ? Response::allow() : Response::deny('You do not have permission to update this company.');
    }

    /**
     * Determine whether the user can delete the company.
     *
     * @param User $user
     * @param Company $company
     * @return mixed
     */
    public function delete(User $user, Company $company)
    {
        $userMemberships = $user->memberships()->pluck('companies.id');

        return $userMemberships->contains($company->id)
            ? Response::allow() : Response::deny('You do not have permission to delete this company.');
    }

    /**
     * Determine whether the user can restore the company.
     *
     * @param User $user
     * @param Company $company
     * @return mixed
     */
    public function restore(User $user, Company $company)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the company.
     *
     * @param User $user
     * @param Company $company
     * @return mixed
     */
    public function forceDelete(User $user, Company $company)
    {
        //
    }
}
