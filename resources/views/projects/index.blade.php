@extends('layouts.admin')

@php
    $profile=asset(Storage::url('uploads/avatar/'));
@endphp

@section('page-title')
    {{__('Projects')}}
@endsection

@section('action-button')
    <div class="all-button-box row d-flex justify-content-end">
        @can('create customer')
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
                <a href="/projects/create"class="btn btn-xs btn-white btn-icon-only width-auto">
                    <i class="fas fa-plus"></i> {{__('Create')}}
                </a>
            </div>
        @endcan
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-2">
            <div class="card card-box">
                <a href="?status=Not started">
                    {{ __('Not started') . ': ' . $projectsWidget->where('status', 'Not started')->count() }}
                </a>
            </div>
        </div>

        <div class="col-3">
            <div class="card card-box">
                <a href="?status=Developing" class="text-primary">
                    {{ __('Developing') . ': ' . $projectsWidget->where('status', 'Developing')->count() }}
                </a>
            </div>
        </div>

        <div class="col-2">
            <div class="card card-box">
                <a href="?status=On holding" class="text-danger">
                    {{ __('On holding') . ': ' . $projectsWidget->where('status', 'On holding')->count() }}
                </a>
            </div>
        </div>

        <div class="col-3">
            <div class="card card-box">
                <a href="?status=Finalized" class="text-success">
                    {{ __('Finalized') . ': ' . $projectsWidget->where('status', 'Finalized')->count() }}
                </a>
            </div>
        </div>

        <div class="col-2">
            <div class="card card-box">
                <a href="?status=Cancelled">
                    {{ __('Cancelled') . ': ' . $projectsWidget->where('status', 'Cancelled')->count() }}
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body py-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0 dataTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th> {{__('Name')}}</th>
                                <th> {{__('Customer')}}</th>
                                <th> {{__('Date start')}}</th>
                                <th> {{__('Date end')}}</th>
                                <th>{{__('Status')}}</th>
                            </tr>
                            </thead>

                            <tbody>
                                @foreach($projects as $project)
                                    <tr>
                                        <td> {{ $loop->iteration }} </td>
                                        <td> {{ $project->name }} </td>
                                        <td> {{ $project->customer->name }} </td>
                                        <td> {{ $project->date_start }} </td>
                                        <td> {{ $project->date_end }} </td>
                                        <td> {{ __($project->status) }} </td>
                                        <td>
                                            <a href="{{ route('projects.show', $project->id) }}" class="edit-icon bg-success">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <a href="{{ route('projects.edit', $project->id) }}" class="edit-icon">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <a href="#" class="delete-icon " data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{ $project->id}}').submit();">
                                                    <i class="fas fa-trash"></i>
                                                </a>

                                            {!! Form::open(['method' => 'DELETE', 'route' => ['projects.destroy', $project->id],'id'=>'delete-form-'.$project->id]) !!}
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
