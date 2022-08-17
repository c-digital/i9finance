@extends('layouts.admin')

@section('page-title')
    {{__('Create schedule')}}
@endsection

@section('content')
    <div class="row">
        {{ Form::open(array('url' => 'schedule', 'class'=>'w-100')) }}
        <div class="col-12">
            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ Form::label('name', __('Name'),['class'=>'form-control-label']) }}

                                {{ Form::text('name', '', array('class' => 'form-control', 'required'=>'required')) }}
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                {{ Form::label('description', __('Description'),['class'=>'form-control-label']) }}

                                {{ Form::textarea('description', '', array('class' => 'form-control')) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 text-right">
            <input type="submit" value="{{__('Create')}}" class="btn-create btn-xs badge-blue radius-10px">
            <input type="button" value="{{__('Cancel')}}" onclick="location.href = '{{route("schedule.index")}}';" class="btn-create btn-xs bg-gray radius-10px">
        </div>

        {{ Form::close() }}
    </div>
@endsection


