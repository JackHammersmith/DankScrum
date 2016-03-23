@extends('layouts.app')

@section('content')
	<script src="{{ URL::asset('js/jquery-sortable.js') }}"></script>
	<div class="container">
		<div class="col-sm-offset-2 col-sm-8">


			<!-- Current Tickets -->

				<div class="panel panel-default">
					<div class="panel-heading">
						Current Tickets
					</div>
                    <div id="ajaxText"></div>

					<div class="panel-body">
                        @can('scrum')
						<script type="application/javascript">
                            var project = {{ $project->id }};
                            refreshBoard(project);
						</script>



                        <div id="scrumBoard"></div>
                        @else
                        <table class="table table-striped ticket-table">
                            <thead>
                            <th>Scrum</th>
                            <th>&nbsp;</th>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <div class="lanes">
                                        @foreach($scrum_data as $data)

                                        <ol id="status-{{ $data['status']->id }}" class="noscrum vertical {{ $data['status']->title }}">
                                            <div class="status-header">{{ $data['status']->title }}</div>
                                            @if (count($data['tickets']) > 0)
                                            @foreach ($data['tickets'] as $ticket)
                                            <li>
                                                <div class="ticket-box">
                                                    <div id="ticket-title">{{ $ticket->title }}</div>
                                                    <div id="ticket-description">@shortify($ticket->description)</div>
                                                </div>
                                            </li>
                                            @endforeach

                                            @endif
                                        </ol>
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        @endcan
					</div>
				</div>
		</div>
	</div>
@endsection