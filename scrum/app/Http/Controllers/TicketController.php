<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Project;
use App\Ticket;
use App\Status;
use App\Severity;
use App\TicketType;
use App\User;
use DB;
use App\Repositories\ProjectRepository;
use App\Repositories\TicketRepository;

class TicketController extends Controller
{
	/**
	 * The ticket repository instance.
	 *
	 * @var TicketRepository
	 */
	protected $tickets;

    /**
     * The project repository instance.
     *
     * @var ProjectRepository
     */
    protected $projects;

	/**
	 * Create a new controller instance.
	 *
	 * @param  TicketRepository  $tickets
	 * @return void
	 */
	public function __construct(TicketRepository $tickets)
	{
		$this->middleware('auth');

		$this->tickets = $tickets;
	}

	/**
	 * Display a list of all of the user's tickets.
	 *
	 * @param  Project  $project
	 * @return Response
	 */
	public function index(Project $project)
	{
        $tickets = $this->tickets->byProject($project);
        //dd($tickets);
        //return $tickets->first()->user;
		return view('tickets.index', [
			'tickets' => $tickets,
            'project' => $project
		]);
	}

	/**
	 * Display a list of all of the user's tickets.
	 *
	 * @param  Request  $request
	 * @return Response
	 */
	public function myTickets(Request $request)
	{
		$user = $request->user();
		$tickets = $this->tickets->forUser($user);
		return view('tickets.my', [
			'tickets' => $tickets,
		]);
	}

    /**
     * Displays a ticket
     *
     * @param Ticket $ticket
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view(Ticket $ticket)
    {
        $status_array = DB::table('status')->get();
        $severity_array = DB::table('severities')->get();
        $ticket_type_array = DB::table('ticket_types')->get();
        $users_array = DB::table('users')->where('role_id', 2)->get(); // make tickets assignable to users only

        return view('tickets.view', [
            'ticket' => $ticket,
            'statuses' => $status_array,
            'severities' => $severity_array,
            'ticket_types' => $ticket_type_array,
            'users' => $users_array
        ]);
    }


    /**
     * Displays ticket create page
     *
     * @param int $project_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function newAction($project_id)
    {
        $status_array = DB::table('status')->get();
        $severity_array = DB::table('severities')->get();
        $ticket_type_array = DB::table('ticket_types')->get();
        $users_array = DB::table('users')->where('role_id', 2)->get(); // make tickets assignable to users only


        // TODO: pass attributes of select fields to view
        return view('tickets.new', [
            'project_id' => $project_id,
            'statuses' => $status_array,
            'severities' => $severity_array,
            'ticket_types' => $ticket_type_array,
            'users' => $users_array
        ]);
   }

	/**
	 * Create a new ticket.
	 *
	 * @param  Request  $request
	 * @return Response
	 */
	public function create(Request $request)
	{
		$this->authorize('create');

		$this->validate($request, [
			'title' => 'required|max:255',
            'project_id' => 'required',
			'status_id' => 'required',
			'severity_id' => 'required',
			'ticket_type_id' => 'required',
            'description' => 'required|max:255',
		]);

		$request->user()->tickets()->create([
			'title' => $request->title,
            'project_id' => $request->project_id,
            'status_id' => $request->status_id,
            'severity_id' => $request->severity_id,
            'ticket_type_id' => $request->ticket_type_id,
            'description' => $request->description,
            'assignee_id' => $request->assignee_id,
		]);

		return redirect('/tickets/'.$request->project_id);
	}

	/**
	 * Update the given ticket.
	 *
	 * @param  Request  $request
	 * @param  Ticket  $ticket
	 * @return Response
	 */
	public function update(Request $request, Ticket $ticket)
	{
		$this->authorize('update', $ticket);

        if ($request->has('title')) {
		    $ticket->title = $request->title;
        }

        if ($request->has('status')) {
            $ticket->status = $request->status;
        }

        if ($request->has('severity')) {
            $ticket->severity = $request->severity;
        }

        if ($request->has('priority')) {
            $ticket->priority = $request->priority;
        }

        if ($request->has('ticket_type')) {
            $ticket->ticket_type = $request->ticket_type;
        }

        if ($request->has('description')) {
            $ticket->description = $request->description;
        }

        if ($request->has('est_time')) {
            $ticket->est_time = $request->est_time;
        }

        if ($request->has('progress')) {
            $ticket->progress = $request->progress;
        }

		if ($request->has('assignee_id')) {
			$ticket->assignee_id = $request->assignee_id;
		}

		$ticket->save();

		return redirect('/ticket/'.$ticket->id);
	}

    /**
     * Changes the status and priority of a ticket
     *
     * @param Request $request
     * @param Ticket $ticket
     */
    public function changeStatus(Request $request, Ticket $ticket)
    {
        $this->authorize('update', $ticket);

	    if ($request->has('status')) {
		    $ticket->status = $request->status;
	    }

	    if ($request->has('priority')) {
		    $ticket->priority = $request->priority;
	    }

        $ticket->save();
    }

	/**
	 * Delete the given ticket.
	 *
	 * @param  Ticket  $ticket
     * @param  Project  $project
	 * @return Response
	 */
	public function delete(Ticket $ticket, Project $project)
	{
		$this->authorize('delete', $ticket);

		$ticket->delete();

		return redirect('/tickets/'.$project->id);
	}
}
