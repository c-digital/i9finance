@extends('layouts.admin')


@section('page-title')
    {{ __($project->name)}}
@endsection


@push('script-page')
    <script>
        function update_status(that) {
            status = $(that).val();
            id = $(that).attr('data-id');

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

        function update_priority(that) {
            priority = $(that).val();
            id = $(that).attr('data-id');

            $.ajax({
                type: 'POST',
                url: '/tasks/priority',
                data: {
                    id: id,
                    priority: priority,
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
                <div class="card-header">
                    {{ __('Tasks') }}
                </div>

                <div class="card-body">
                    <a href="{{ "/projects/$id/tasks/create" }}" class="btn-create btn-xs badge-blue radius-10px">{{ __('Add task') }}</a>
                    <a href="{{ "/projects/$id/tasks?view=kanban" }}" class="btn-create btn-xs bg-gray radius-10px">{{ __('View as kan ban') }}</a>

                    <hr>

                    <div class="row">
                        <div class="col-2">
                            <div class="card card-box">
                                {{ __('To start') . ': ' . $project->tasks->where('status', 'To start')->count() }}
                            </div>
                        </div>

                        <div class="col-2">
                            <div class="card card-box text-primary">
                                {{ __('In progress') . ': ' . $project->tasks->where('status', 'In progress')->count() }}
                            </div>
                        </div>

                        <div class="col-2">
                            <div class="card card-box">
                                {{ __('On trial') . ': ' . $project->tasks->where('status', 'On trial')->count() }}
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="card card-box text-success">
                                {{ __('Wait for reply') . ': ' . $project->tasks->where('status', 'Wait for reply')->count() }}
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="card card-box text-success">
                                {{ __('Complete') . ': ' . $project->tasks->where('status', 'Complete')->count() }}
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped mb-0 dataTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Date start')}}</th>
                                <th>{{__('Date end')}}</th>
                                <th>{{__('Cost')}}</th>
                                <th>{{__('Priority')}}</th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody>
                                @foreach($project->tasks as $task)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $task->theme }}</td>

                                        <td>{{ Form::select('status', $statuses, $task->status, ['data-id' => $task->id, 'class' => 'form-control select2', 'onchange' => 'update_status(this)']) }}</td>

                                        <td>{{ $task->date_start }}</td>
                                        <td>{{ $task->date_end }}</td>
                                        <td>{{ $task->cost }}</td>

                                        <td>{{ Form::select('priority', $priorities, $task->priority, ['data-id' => $task->id, 'class' => 'form-control select2', 'onchange' => 'update_priority(this)']) }}</td>

                                        <td nowrap>
                                            <a href="{{ '/projects/' . $project->id . '/tasks/' . $task->id . '/edit' }}" class="edit-icon">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <a href="#" class="delete-icon " data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{ $task->id}}').submit();">
                                                <i class="fas fa-trash"></i>
                                            </a>

                                            <form method="POST" id="{{ 'delete-form-'.$task->id }}" action="{{ '/projects/' . $project->id . '/tasks/' . $task->id }}">
                                                @method('DELETE')
                                                @csrf
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
