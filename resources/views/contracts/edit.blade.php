@extends('layouts.admin')

@section('page-title')
    {{__('Edit contract')}}
@endsection

@push('script-page')
    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endpush

@section('content')
    <div class="row">
        {{ Form::model($contract, array('route' => array('contracts.update', $contract->id), 'method' => 'PUT')) }}
        <div class="col-6">
            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ Form::label('customer_id', __('Customer'),['class'=>'form-control-label']) }}

                                {{ Form::select('customer_id', $customers, null, array('class' => 'form-control select2','id'=>'customer', 'required'=>'required')) }}
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                {{ Form::label('project_id', __('Project'),['class'=>'form-control-label']) }}

                                {{ Form::select('project_id', $projects, null, array('class' => 'form-control select2','id'=>'project', 'required'=>'required')) }}
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                {{ Form::label('theme', __('Theme'),['class'=>'form-control-label']) }}

                                {{ Form::text('theme', null, array('class' => 'form-control', 'required'=>'required')) }}
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                {{ Form::label('amount', __('Contract amount'),['class'=>'form-control-label']) }}

                                {{ Form::number('amount', null, array('class' => 'form-control')) }}
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                {{ Form::label('type', __('Contract type'),['class'=>'form-control-label']) }}

                                {{ Form::select('type', ['' => '', 'Criative Digital' => 'Criative Digital', 'Página web' => 'Página web'], null, array('class' => 'form-control', 'id'=>'customer', 'required'=>'required')) }}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('date_start', __('Date start'),['class'=>'form-control-label']) }}

                                {{ Form::text('date_start', null, array('class' => 'form-control datepicker')) }}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('date_end', __('Date end'),['class'=>'form-control-label']) }}

                                {{ Form::text('date_end', null, array('class' => 'form-control datepicker')) }}
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                {{ Form::label('description', __('Description'),['class'=>'form-control-label']) }}

                                {{ Form::textarea('description', null, array('class' => 'form-control')) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="card">
                <div class="card-body">

                </div>
            </div>
        </div>

        <div class="col-12 text-right">
            <input type="submit" value="{{__('Save')}}" class="btn-create btn-xs badge-blue radius-10px">
            <input type="button" value="{{__('Cancel')}}" onclick="location.href = '{{route("contracts.index")}}';" class="btn-create btn-xs bg-gray radius-10px">
        </div>

        {{ Form::close() }}
    </div>
@endsection


