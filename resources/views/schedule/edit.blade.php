@extends('layouts.admin')

@section('page-title')
    {{__('Edit schedule')}}
@endsection

@section('content')
    <div class="row">
        {{ Form::model($schedule, array('route' => array('schedule.update', $schedule->id), 'method' => 'PUT')) }}
            <div class="col-12">
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{ Form::label('name', __('Name'),['class'=>'form-control-label']) }}

                                    {{ Form::text('name', null, array('class' => 'form-control', 'required'=>'required')) }}
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

            <div class="col-12 text-right">
                <input type="submit" value="{{__('Save')}}" class="btn-create btn-xs badge-blue radius-10px">
                <input type="button" value="{{__('Cancel')}}" onclick="location.href = '{{route("schedule.index")}}';" class="btn-create btn-xs bg-gray radius-10px">
            </div>

        {{ Form::close() }}
    </div>
@endsection


