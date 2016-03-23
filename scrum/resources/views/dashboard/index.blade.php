@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="col-sm-offset-2 col-sm-8">
            <!-- Current Tickets -->
            @if (count($tickets) > 0)
            <div class="panel panel-default">
                <div class="panel-heading">
                    My Current Tickets
                </div>

                <table class="table table-striped ticket-table">
                    <thead>
                    <th>Title</th>
                    <th>Description</th>

                    </thead>
                    <tbody>
                    @foreach ($tickets as $ticket)
                    <tr>
                        <td class="table-text"><div><a href="/ticket/{{ $ticket->id }}">{{ $ticket->title }}</a></div></td>
                        <td class="table-text"><div>{{ $ticket->description }}</div></td>

                    </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="panel-body">

                </div>
            </div>
            {!! $tickets->links() !!}
            @endif

			<!-- Current Projects -->
			@if (count($projects) > 0)
				<div class="panel panel-default">
					<div class="panel-heading">
						Current Projects
					</div>

					<div class="panel-body">
						<table class="table table-striped project-table">
							<thead>
								<th>Project</th>
								<th>&nbsp;</th>
							</thead>
							<tbody>
								@foreach ($projects as $project)
									<tr>
										<td class="table-text"><div><a href="/tickets/{{ $project->id }}">{{ $project->title }}</a></div></td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			@endif
		</div>
	</div>
@endsection
