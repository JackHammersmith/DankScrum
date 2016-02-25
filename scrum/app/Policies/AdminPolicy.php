<?php

namespace App\Policies;

use App\User;
use App\Project;
use App\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    public function before($user)
    {
        if ($user->role_id == 1) {
            return true;
        }
    }

    /**
     * Determine if the given user can view the admin page.
     *
     * @param  User  $user
     * @return bool
     */
    public function viewAdmin(User $user)
    {
        return $user->role_id == 1;
    }

	/**
	 * Determine if the given user can delete the given project.
	 *
	 * @param  User  $user
	 * @param  Project  $project
	 * @return bool
	 */
	public function delete(User $user, Project $project)
	{
		return $user->id === $project->user_id;
	}

	/**
	 * Determine if the given user can update the given project.
	 *
	 * @param  User  $user
	 * @param  Project  $project
	 * @return bool
	 */
	public function update(User $user, Project $project)
	{
		return $user->id === $project->user_id;
	}

    /**
     * Determine if the given user can edit the given project.
     *
     * @param  User  $user
     * @param  Project  $project
     * @return bool
     */
    public function edit(User $user, Project $project)
    {
        return $user->id === $project->user_id;
    }
}
