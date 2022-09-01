@extends('layouts.admin')


@section('page-title')
    {{ __($project->name)}}
@endsection


@section('content')
    <ul class="mt-3 nav nav-pills">
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="">
                <i class="fa fa-th"></i>
                {{ __('Description') }}
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ "/projects/$id/tasks" }}">
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
            <a class="nav-link active" href="{{ "/projects/$id/contracts" }}">
                <i class="fa fa-file"></i>
                {{ __('Contracts') }}
            </a>
        </li>
    </ul>

    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    {{ __('Contracts') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0 dataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('Theme')}}</th>
                                    <th>{{__('Customer')}}</th>
                                    <th>{{__('Type')}}</th>
                                    <th>{{__('Amount')}}</th>
                                    <th>{{__('Date start')}}</th>
                                    <th>{{__('Date end')}}</th>
                                    <th>{{__('Project')}}</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($project->contracts as $contract)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $contract->theme }}</td>
                                        <td>{{ $contract->customer->name }}</td>
                                        <td>{{ $contract->type }}</td>
                                        <td>{{ $contract->amount }}</td>
                                        <td>{{ $contract->date_start }}</td>
                                        <td>{{ $contract->date_end }}</td>
                                        <td>{{ $contract->project->name }}</td>
                                        <td nowrap>
                                            <a href="{{ route('contracts.show', $contract->id) }}" class="edit-icon bg-success">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <a href="{{ route('contracts.edit', $contract->id) }}" class="edit-icon">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <a href="#" class="delete-icon " data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{ $contract->id}}').submit();">
                                                    <i class="fas fa-trash"></i>
                                                </a>

                                            {!! Form::open(['method' => 'DELETE', 'route' => ['contracts.destroy', $contract->id],'id'=>'delete-form-'.$contract->id]) !!}
                                            {!! Form::close() !!}
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
