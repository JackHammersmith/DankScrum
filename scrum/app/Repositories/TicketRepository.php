<?php

namespace App\Repositories;

use App\User;
use App\Ticket;
use App\Project;

class TicketRepository
{
    /**
     * Get all tickets created by given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function byUser(User $user)
    {
        return Ticket::where('creator_id', $user->id)
                    ->orderBy('created_at', 'asc')
                    ->get();
    }

    /**
     * Get all tickets by project.
     *
     * @param  Project  $project
     * @return Collection
     */
    public function byProject(Project $project)
    {
        return Ticket::where('project_id', $project->id)
            ->orderBy('priority', 'desc')
            ->get();
    }

	/**
	 * Get all tickets assigned to a given user.
	 *
	 * @param  User  $user
	 * @return Collection
	 */
	public function forUser(User $user)
	{
		return Ticket::where('assignee_id', $user->id)
			->orderBy('priority', 'desc')
            ->paginate(3);
	}
}
