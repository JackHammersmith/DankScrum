<?php

namespace App;

use App\Role;
use App\Project;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

	/**
	 * Get all tickets of the user.
	 */
	public function tickets()
	{
		return $this->hasMany(Ticket::class);
	}

    /**
     * Gets role assigned to user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function role()
    {
        return $this->hasOne(Role::class);
    }

    /**
     * Get the project assigned to the user.
     */
    public function projects()
    {
        //return $this->hasMany('App\TicketType', 'id');
        return $this->belongsToMany(Project::class, 'users_projects', 'user_id', 'project_id');
    }
}
