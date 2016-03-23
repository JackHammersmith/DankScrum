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
use DB;
use App\Repositories\ProjectRepository;
use App\Repositories\TicketRepository;

class ScrumController extends Controller
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
		$statuses = Status::all();

		$data = array();


		$i = 0;
		foreach ($statuses as $status){

			$data[] = array(
				'status' => $status,
				'tickets' => array(),
			);

			foreach ($tickets as $ticket){
				if ($ticket->status->id == $status->id){
					array_push($data[$i]['tickets'], $ticket);
				}
			}
			$i++;
		}
//		dd($data);


		return view('scrum.index', [
			'scrum_data' => $data,
            'project' => $project
		]);
	}

    /**
     * Display a list of all of the user's tickets.
     *
     * @param  Project  $project
     * @return Response
     */
    public function scrum(Project $project)
    {
        $tickets = $this->tickets->byProject($project);
        $statuses = Status::all();

        $data = array();

        $i = 0;
        foreach ($statuses as $status){

            $data[] = array(
                'status' => $status,
                'tickets' => array(),
            );

            foreach ($tickets as $ticket){
                if ($ticket->status->id == $status->id){
                    array_push($data[$i]['tickets'], $ticket);
                }
            }
            $i++;
        }
//		dd($data);


        return view('scrum.board', [
            'scrum_data' => $data,
            'project' => $project
        ]);
    }

    /**
     * Changes the status of a ticket
     *
     * @param Request $request
     * @param Ticket $ticket
     */
    public function changeStatus(Request $request, Ticket $ticket)
    {
        $this->authorize('update', $ticket);
        $ticket->status = $request->status;
        $ticket->save();
    }
}
