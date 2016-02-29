<?php

	namespace App\Http\Controllers;

	use Illuminate\Http\Request;

	use App\Http\Requests;
	use App\Http\Controllers\Controller;

	use App\Project;
    use App\Ticket;
	use App\Repositories\ProjectRepository;
    use App\Repositories\TicketRepository;
    use Illuminate\Support\Facades\Auth;

    class DashboardController extends Controller
	{
		/**
		 * The project repository instance.
		 *
		 * @var ProjectRepository
		 */
		protected $projects;

        /**
         * The ticket repository instance.
         *
         * @var TicketRepository
         */
        protected $tickets;

		/**
		 * Create a new controller instance.
		 *
		 * @param  ProjectRepository  $projects
         * @param TicketRepository $tickets
		 * @return void
		 */
		public function __construct(ProjectRepository $projects, TicketRepository $tickets)
		{
			$this->middleware('auth');

			$this->projects = $projects;
			$this->tickets = $tickets;

		}

		/**
		 * Display a list of all of the user's tickets.
		 *
		 * @return Response
		 */
		public function index()
		{
            $user = Auth::user();
            //dd($user);
			$projects = Project::all();
            $tickets = $this->tickets->forUser($user);
			return view('dashboard.index', [
				//'projects' => $this->projects->forUser($request->user()),
				'projects' => $projects,
                'tickets' => $tickets
			]);
		}

        /**
         * Display a project.
         *
         * @param  Request  $request
         * @return Response
         */
        public function view(Request $request)
        {
            return view('tickets.index', [
                'tickets' => $this->tickets->byProject($request->project()),
            ]);
        }

		/**
		 * Create a new project.
		 *
		 * @param  Request  $request
		 * @return Response
		 */
		public function create(Request $request)
		{
			$this->validate($request, [
				'title' => 'required|max:255',
			]);

			$request->user()->projects()->create([
				'title' => $request->title,
			]);

			return redirect('/projects');
		}

		/**
		 * Update the given project.
		 *
		 * @param  Project  $project
		 * @return Response
		 */
		public function edit(Project $project)
		{
			$this->authorize('edit', $project);

			return view('projects.edit', [
				'project' => $project
			]);
		}

		/**
		 * Update the given project.
		 *
		 * @param  Request  $request
		 * @param  Project  $project
		 * @return Response
		 */
		public function update(Request $request, Project $project)
		{
			$this->authorize('update', $project);

			$project->title = $request->title;

			$project->save();

			return redirect('/projects');
		}

		/**
		 * Delete the given ticket.
		 *
		 * @param  Request  $request
		 * @param  Project  $project
		 * @return Response
		 */
		public function delete(Request $request, Project $project)
		{
			$this->authorize('delete', $project);

            $project->delete();

			return redirect('/projects');
		}
	}
