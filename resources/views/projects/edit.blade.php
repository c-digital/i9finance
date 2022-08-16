@extends('layouts.admin')

@section('page-title')
    {{__('Create project')}}
@endsection

@push('script-page')
    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endpush

@section('content')
    {{ Form::open(array('url' => 'projects', 'class'=>'w-100')) }}
        <div class="row mt-4">
            <div class="col-12">
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{ Form::label('name', __('Name'),['class'=>'form-control-label']) }}

                                    {{ Form::text('name', $project->name, array('class' => 'form-control', 'required'=>'required')) }}
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    {{ Form::label('customer_id', __('Customer'),['class'=>'form-control-label']) }}

                                    {{ Form::select('customer_id', $customers, $project->customer_id, array('class' => 'form-control','id'=>'customer', 'required'=>'required')) }}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('billing_type', __('Billing type'),['class'=>'form-control-label']) }}

                                    {{ Form::select('billing_type', $billing_type, $project->billing_type, array('class' => 'form-control','id'=>'billing_type', 'required'=>'required')) }}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('status', __('Status'),['class'=>'form-control-label']) }}

                                    {{ Form::select('status', $status, $project->status, array('class' => 'form-control','id'=>'status')) }}
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    {{ Form::label('total_cost', __('Total cost'),['class'=>'form-control-label']) }}

                                    {{ Form::number('total_cost', $project->total_cost, array('class' => 'form-control', 'required'=>'required')) }}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('estimated_hours', __('Estimated hours'),['class'=>'form-control-label']) }}

                                    {{ Form::number('estimated_hours', $project->estimated_hours, array('class' => 'form-control', 'required'=>'required')) }}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('project_members', __('Project members'),['class'=>'form-control-label']) }}

                                    <select name="project_members[]" class="select2 form-control" multiple>
                                        <option value=""></option>

                                        @foreach($members as $id => $name)
                                            <option {{ in_array($id, $project->project_members) ? 'selected' : '' }} value="{{ $id }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('date_start', __('Date start'),['class'=>'form-control-label']) }}

                                    {{ Form::text('date_start', $project->date_start, array('class' => 'form-control datepicker', 'required'=>'required')) }}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('date_end', __('Date end'),['class'=>'form-control-label']) }}

                                    {{ Form::text('date_end', $project->date_end, array('class' => 'form-control datepicker')) }}
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    {{ Form::label('description', __('Description'),['class'=>'form-control-label']) }}

                                    {{ Form::textarea('description', $project->description, ['class' => 'form-control']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 text-right">
                <input type="submit" value="{{__('Save')}}" class="btn-create btn-xs badge-blue radius-10px">
                <input type="button" value="{{__('Cancel')}}" onclick="location.href = '{{route("contracts.index")}}';" class="btn-create btn-xs bg-gray radius-10px">
            </div>
        </div>
    {{ Form::close() }}
@endsection


