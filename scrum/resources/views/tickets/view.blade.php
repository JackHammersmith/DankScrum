@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="col-sm-offset-2 col-sm-8">
			<div class="panel panel-default">
				<div class="panel-heading">
					{{ $ticket->title }}
				</div>

                <table class="table table-striped ticket-table">
                    <thead>
                        <th>Title</th>

                        <th>Progress</th>
                        <th>Estimated Time</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Severity</th>
                        <th>Type</th>
                        <th>Assigned to</th>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="table-text"><div>{{ $ticket->title }}</div></td>
                        <td class="table-text"><div>{{ $ticket->progress }}</div></td>
                        <td class="table-text"><div>{{ $ticket->est_time }}</div></td>
                        <td class="table-text"><div>{{ $ticket->priority }}</div></td>
                        <td class="table-text"><div>{{ $ticket->status->title }}</div></td>
                        <td class="table-text"><div>{{ $ticket->severity->title }}</div></td>
                        <td class="table-text"><div>{{ $ticket->ticket_type->title }}</div></td>
	                    <td class="table-text"><div>{{ $ticket->assignee->name }}</div></td>

                    </tr>
                    </tbody>
                </table>

				@can('update', $ticket)
                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')
                    <!-- New Ticket Form -->
                    <form action="/ticket/update/{{$ticket->id}}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}

                        <!-- Ticket Name -->
                        <div class="form-group">
                            <div class="formrow">
                                <label for="ticket-title" class="control-label">New Ticket Title</label>
                                <input type="text" name="title" id="ticket-title" class="" value="{{ $ticket->title }}">
                            </div>


                            <div class="formrow">
                                <label for="ticket-status" class="control-label">Status</label>

                                <select name="status_id" id="ticket-status">
                                    @foreach ($statuses as $status)
                                    <option value="{{ $status->id }}">{{ $status->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="formrow">
                                <label for="ticket-severity" class="control-label">Severity</label>

                                <select name="severity_id" id="ticket-severity">
                                    @foreach ($severities as $severity)
                                    <option value="{{ $severity->id }}">{{ $severity->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="formrow">
                                <label for="ticket-type" class="control-label">Type</label>

                                <select name="ticket_type_id" id="ticket-type">
                                    @foreach ($ticket_types as $ticket_type)
                                    <option value="{{ $ticket_type->id }}">{{ $ticket_type->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="formrow">
                                <label for="ticket-priority" class="control-label">Priority</label>
                                <input id="ticket-priority" name="priority" value="{{ $ticket->priority }}">
                            </div>
                            <div class="formrow">
                                <label for="ticket-est_time" class="control-label">Estimated time</label>
                                <input id="ticket-est_time" name="est_time" value="{{ $ticket->est_time }}">
                            </div>
                            <div class="formrow">
                                <label for="ticket-progress" class="control-label">Progress</label>
                                <input id="ticket-progress" name="progress" value="{{ $ticket->progress }}">
                            </div>
                            <div class="formrow">
                                <label for="ticket-assignee" class="control-label">Assigned to:</label>

                                <select name="assignee_id" id="ticket-assignee">
                                    @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="formrow">
                                <label for="ticket-description" class="control-label">Description</label>

                                <textarea name="description" cols="50" rows="10">{{ $ticket->description }}</textarea>
                            </div>


                        </div>

                        <!-- Add Ticket Button -->
                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-default" style="margin: 0 auto; display: block;">
                                    <i class="fa fa-btn fa-plus"></i>Update Ticket
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @endcan
        </div>
	</div>
@endsection
