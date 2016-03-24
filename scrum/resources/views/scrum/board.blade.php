@extends('layouts.scrum')
@section('content')
<script src="{{ URL::asset('js/jquery-sortable.js') }}"></script>
<script src="{{ URL::asset('js/ajax.js') }}"></script>
<script type="application/javascript">

    var origPosition;
    var adjustment;
    jQuery(function () {
        var group = $("ol.scrum").sortable({
            group: 'scrum',
            pullPlaceholder: false,
            vertical: false,

            // animation on drop
            onDrop: function ($item, container, _super) {
                var project = {{ $project->id }};
                var $clonedItem = $('<li/>').css({height: 0});
                $item.before($clonedItem);
                $clonedItem.animate({'height': $item.height()});

                var allowed = true;
                var position = $clonedItem.position();
                if ($item.position().left < origPosition.left) {
                    alert('nicht erlaubt!');
                    //refreshBoard(project);
                    allowed = false;
                }

                $item.animate(position, function () {
                    $clonedItem.detach();
                    _super($item, container);
                });


                var data = group.sortable("serialize").get();

                var jsonString = JSON.stringify(data, null, ' ');
                //console.log(jsonString);
                if (allowed){
                    statusChange(jsonString);
                }


                refreshBoard(project);
            },

            // set $item relative to cursor position
            onDragStart: function ($item, container, _super) {
                origPosition = $item.position();
                var offset = $item.offset(),
                    pointer = container.rootGroup.pointer;

                adjustment = {
                    left: pointer.left - offset.left,
                    top: pointer.top - offset.top
                };

                _super($item, container);
            },
            onDrag: function ($item, position) {
                $item.css({
                    left: position.left - adjustment.left,
                    top: position.top - adjustment.top
                });
            }
        });
    });
</script>


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

                <ol id="status-{{ $data['status']->id }}" class="scrum vertical {{ $data['status']->title }}">
                    <div class="status-header">{{ $data['status']->title }}</div>
                    @if (count($data['tickets']) > 0)
                    @foreach ($data['tickets'] as $ticket)
                    <li data-ticket-priority="{{ $ticket->priority }}" data-status-id="{{ $data['status']->id }}"
                        data-ticket-id="{{ $ticket->id }}">
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
@endsection
