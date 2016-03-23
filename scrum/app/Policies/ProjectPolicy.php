<?php

namespace App\Policies;

use App\User;
use App\Project;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

	public function before($user)
	{
		if ($user->role_id == 1) {
			return true;
		}
	}

	/**
	 * Determine if the given user can create a new project.
	 *
	 * @param User $user
	 *
	 * @return bool
	 */
	public function create(User $user)
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
     * Determine if the given user can access scrum functionality.
     *
     * @param  User  $user
     * @return bool
     */
    public function scrum(User $user)
    {
        return $user->role_id == 1 || $user->role_id == 2;
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
