<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\Project;

class AuthServiceProvider extends ServiceProvider
{
	/**
	 * The policy mappings for the application.
	 *
	 * @var array
	 */
	protected $policies = [
		'App\Ticket' => 'App\Policies\TicketPolicy',
		'App\Project' => 'App\Policies\ProjectPolicy',
        'App\Admin' => 'App\Policies\AdminPolicy',
	];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        $gate->define('viewAdmin', function ($user) {
            return $user->role_id == 1;
        });

	    $gate->define('admin', function ($user) {
		    return $user->role_id == 1;
	    });

	    $gate->define('create-project', function ($user) {
		    return $user->role_id == 1;
	    });

	    $gate->define('create-ticket', function ($user, $project_id) {
            if ($user->role_id == 1){
                return true;
            }
            return $user->projects->contains($project_id);
	    });

        $gate->define('create', function ($user) {
            return $user->role_id == 1 || $user->role_id == 2;
        });

	    $gate->define('update', function ($user, $ticket) {
		    return $user->role_id == 1 || $user->id === $ticket->user_id;
	    });

	    $gate->define('delete', function ($user, $ticket) {
		    return $user->role_id == 1 || $user->id === $ticket->user_id;
	    });

        $gate->define('scrum', function ($user) {
            return $user->role_id == 1 || $user->role_id == 2;
        });
    }
}
