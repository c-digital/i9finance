@extends('layouts.admin')


@section('page-title')
    {{ __($project->name)}}
@endsection


@section('action-button')
    <a href="{{ "/projects/$id/tasks/create" }}" class="btn-create btn-xs badge-blue radius-10px">{{ __('Add task') }}</a>
@endsection


@push('css-page')
    <style>
        .container {
            width: 70%;
            min-width: 50%;
            margin: auto;
            display: flex;
            flex-direction: column;
        }

        .kanban-block {
            border: 1px solid black;
            margin: 0px 5px 5px 0px;
        }

        .kanban-board {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            font-family: sans-serif;
        }

        .kanban-block,
        .create-new-task-block {
            padding: 0.6rem;
            width: 30.5%;
            min-width: 14rem;
            min-height: 4.5rem;
            border-radius: 0.3rem;
        }

        .task {
            background-color: white;
            margin: 0.2rem 0rem 0.3rem 0rem;
            border: 0.1rem solid black;
            border-radius: 0.2rem;
            padding: 0.5rem 0.2rem 0.5rem 2rem;
        }
    </style>
@endpush


@push('script-page')
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <script>
        function drag(ev) {
            ev.dataTransfer.setData("text", ev.target.id);
        }

        function allowDrop(ev) {
            ev.preventDefault();
        }

        function drop(ev) {
            ev.preventDefault();
            var data = ev.dataTransfer.getData("text");
            ev.currentTarget.appendChild(document.getElementById(data));

            status = $(ev.currentTarget).attr('data-status');
            id = $('#' + data).attr('data-id');

            $.ajax({
                type: 'POST',
                url: '/tasks/status',
                data: {
                    id: id,
                    status: status,
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    console.log(response);
                },
                error: function (error) {
                    console.log(error.responseText);
                }
            });
        }
    </script>
@endpush


@section('content')
    <ul class="mt-3 nav nav-pills">
        <li class="nav-item">
            <a class="nav-link" href="{{ "/projects/$id" }}">
                <i class="fa fa-th"></i>
                {{ __('Description') }}
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link active" href="{{ "/projects/$id/tasks" }}">
                <i class="fa fa-check-circle"></i>
                {{ __('Tasks') }}
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ "/projects/$id/files" }}">
                <i class="fa fa-copy"></i>
                {{ __('Files') }}
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ "/projects/$id/contracts" }}">
                <i class="fa fa-file"></i>
                {{ __('Contracts') }}
            </a>
        </li>
    </ul>

    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <div class="kanban-board">
                            <div class="kanban-block" data-status="To start" ondrop="drop(event)" ondragover="allowDrop(event)">
                                <strong>{{ __('To start') }}</strong>                                

                                @foreach($project->tasks->where('status', 'To start') as $task)
                                    <div class="task" data-id="{{ $task->id }}" id="{{ Str::slug($task->theme) }}" draggable="true" ondragstart="drag(event)">
                                        <span>{{ $task->theme }}</span>
                                    </div>
                                @endforeach
                            </div>

                            <div class="kanban-block" data-status="In progress" ondrop="drop(event)" ondragover="allowDrop(event)">
                                <strong>{{ __('In progress') }}</strong>

                                @foreach($project->tasks->where('status', 'In progress') as $task)
                                    <div class="task" data-id="{{ $task->id }}" id="{{ Str::slug($task->theme) }}" draggable="true" ondragstart="drag(event)">
                                        <span>{{ $task->theme }}</span>
                                    </div>
                                @endforeach
                            </div>

                            <div class="kanban-block" data-status="On trial" ondrop="drop(event)" ondragover="allowDrop(event)">
                                <strong>{{ __('On trial') }}</strong>

                                @foreach($project->tasks->where('status', 'On trial') as $task)
                                    <div class="task" data-id="{{ $task->id }}" id="{{ Str::slug($task->theme) }}" draggable="true" ondragstart="drag(event)">
                                        <span>{{ $task->theme }}</span>
                                    </div>
                                @endforeach
                            </div>

                            <div class="kanban-block" data-status="Wait for reply" ondrop="drop(event)" ondragover="allowDrop(event)">
                                <strong>{{ __('Wait for reply') }}</strong>

                                @foreach($project->tasks->where('status', 'Wait for reply') as $task)
                                    <div class="task" data-id="{{ $task->id }}" id="{{ Str::slug($task->theme) }}" draggable="true" ondragstart="drag(event)">
                                        <span>{{ $task->theme }}</span>
                                    </div>
                                @endforeach
                            </div>

                            <div class="kanban-block" data-status="Complete" ondrop="drop(event)" ondragover="allowDrop(event)">
                                <strong>{{ __('Complete') }}</strong>

                                @foreach($project->tasks->where('status', 'Complete') as $task)
                                    <div class="task" data-id="{{ $task->id }}" id="{{ Str::slug($task->theme) }}" draggable="true" ondragstart="drag(event)">
                                        <span>{{ $task->theme }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
