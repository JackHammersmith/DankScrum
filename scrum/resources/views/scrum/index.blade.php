@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="col-sm-offset-2 col-sm-8">

			<!-- Current Tickets -->
			@if (count($tickets) > 0)
				<div class="panel panel-default">
					<div class="panel-heading">
						Current Tickets
					</div>

					<div class="panel-body">
						<table class="table table-striped ticket-table">
							<thead>
								<th>Ticket</th>
								<th>&nbsp;</th>
							</thead>
							<tbody>
								@foreach ($tickets as $ticket)
									<tr id="ticket-{{ $ticket->id }}" class="ticket">
										<td class="table-text"><div>{{ $ticket->title }}</div></td>
                                        <td class="table-text"><div>{{ $ticket->description }}</div></td>
                                        <td class="table-text"><div>{{ $ticket->progress }}</div></td>
                                        <td class="table-text"><div>{{ $ticket->est_time }}</div></td>
										<td class="table-text"><div>{{ $ticket->status->title }}</div></td>
										<td class="table-text"><div>{{ $ticket->severity->title }}</div></td>
										<td class="table-text"><div>{{ $ticket->ticket_type->title }}</div></td>
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
