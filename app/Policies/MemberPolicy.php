<?php

namespace App\Policies;

use App\Membership;
use App\Member;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class MemberPolicy
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
     * Determine whether the user can view any employees.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view a member.
     *
     * @param User $user
     * @param  \App\Member  $member
     * @return mixed
     */
    public function view(User $user, Member $member)
    {
        //
    }

    /**
     * Determine whether the user can create members.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the member.
     *
     * @param User $user
     * @param  \App\Member  $member
     * @return mixed
     */
    public function update(User $user, Member $member)
    {
        $userMemberships = $user->memberships()->pluck('membership.id');

        return $userMemberships->contains($member->membership_id)
            ? Response::allow() : Response::deny('You do not have permission to update a member of this membership.');
    }

    /**
     * Determine whether the user can delete the employee.
     *
     * @param User $user
     * @param  \App\Employee  $employee
     * @return mixed
     */
    public function delete(User $user, Member $member)
    {
        $userMemberships = $user->memberships()->pluck('membership.id');

        return $userMemberships->contains($member->membership_id)
            ? Response::allow() : Response::deny('You do not have permission to update a member for this company.');
    }

    /**
     * Determine whether the user can restore the employee.
     *
     * @param User $user
     * @param  \App\Employee  $employee
     * @return mixed
     */
    public function restore(User $user, Member $member)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the employee.
     *
     * @param User $user
     * @param  \App\Employee  $employee
     * @return mixed
     */
    public function forceDelete(User $user, Member $member)
    {
        //
    }
}
