@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="col-sm-offset-2 col-sm-8">
			@can('create-ticket', $project->id)
			<div class="panel panel-default">
				<div class="panel-heading">
					New Ticket
				</div>

				<div class="panel-body">
					<!-- Display Validation Errors -->
					@include('common.errors')

					<a href="/ticket/new/{{ $project->id }}">Create Ticket</a>

				</div>
			</div>
			@endcan

			<!-- Current Tickets -->
			@if (count($tickets) > 0)
				<div class="panel panel-default">
					<div class="panel-heading">
						Current Tickets
					</div>

                    <table class="table table-striped ticket-table">
                        <thead>
                            <th>Title</th>
                            <th>Description</th>

                            <th style="width:100px;">Assigned to</th>
                        </thead>
                        <tbody>
                        @foreach ($tickets as $ticket)
                        <tr>
	                        <td class="table-text"><div><a href="/ticket/{{ $ticket->id }}">{{ $ticket->title }}</a></div></td>
	                        <td class="table-text"><div>{{ $ticket->description }}</div></td>

	                        <td class="table-text"><div>{{ $ticket->assignee->name }}</div></td>

                            <!-- Ticket Delete Button -->
	                        @can('delete', $ticket)
                            <td>
                                <form action="/ticket/{{ $ticket->id }}/{{ $project->id }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button type="submit" id="delete-ticket-{{ $ticket->id }}" class="btn btn-danger">
                                        <i class="fa fa-btn fa-trash"></i>Delete
                                    </button>
                                </form>
                            </td>
                            @else
                            <td>
                                <button class="btn btn-regular">
                                    <i class="fa fa-btn fa-trash"></i>Delete
                                </button>
                            </td>
	                        @endcan
	                        @can('update', $ticket)
                            <td>
                                <a href="/ticket/{{ $ticket->id }}">
                                    <button class="btn btn-regular">
                                        Edit
                                    </button>
                                </a>
                            </td>
	                        @endcan
                        </tr>
                        @endforeach
                        </tbody>
                    </table>

					<div class="panel-body">

					</div>
				</div>
			@endif
		</div>
	</div>
@endsection
