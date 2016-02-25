<?php

namespace App\Policies;

use App\User;
use App\Ticket;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketPolicy
{
    use HandlesAuthorization;

	public function before($user)
	{
		if ($user->role_id == 1) {
			return true;
		}
	}

	/**
	 * Determine if the given user can create a new ticket.
	 *
	 * @param User $user
	 * @return bool
	 */
	public function create(User $user)
	{
		return $user->role_id == 1 || $user->role_id == 2;
	}

	/**
	 * Determine if the given user can delete the given task.
	 *
	 * @param  User  $user
	 * @param  Ticket  $ticket
	 * @return bool
	 */
	public function delete(User $user, Ticket $ticket)
	{
		return $user->id === $ticket->user_id || $user->role_id == 1 ;
	}

	/**
	 * Determine if the given user can update the given task.
	 *
	 * @param  User  $user
	 * @param  Ticket  $ticket
	 * @return bool
	 */
	public function update(User $user, Ticket $ticket)
	{
		return $user->id === $ticket->user_id || $user->role_id == 1 || $user->id === $ticket->assignee_id;
	}
}
