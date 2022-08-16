@extends('layouts.admin')

@php
    $profile=asset(Storage::url('uploads/avatar/'));
@endphp

@section('page-title')
    {{__('Contracts')}}
@endsection

@section('action-button')
    <div class="all-button-box row d-flex justify-content-end">
        @can('create customer')
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
                <a href="/contracts/create"class="btn btn-xs btn-white btn-icon-only width-auto">
                    <i class="fas fa-plus"></i> {{__('Create')}}
                </a>
            </div>
        @endcan
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body py-0">
                    <div class="row p-4">
                        <div class="col-3">
                            <div class="card card-box">
                                {{ __('Active') . ': ' . $active }}
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="card card-box text-primary">
                                {{ __('Expired') . ': ' . $expired }}
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="card card-box">
                                {{ __('About to expire') . ': ' . $about_to_expire }}
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="card card-box text-success">
                                {{ __('Recently added') . ': ' . $recently_added }}
                            </div>
                        </div>
                    </div>

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
                                @foreach($contracts as $contract)
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
