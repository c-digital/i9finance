@extends('layouts.admin')

@section('page-title')
    {{__('Create task')}}
@endsection

@push('script-page')
    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endpush

@section('content')
    {{ Form::open(array('url' => "projects/$id/tasks", 'class'=>'w-100')) }}
        <div class="row mt-4">
            <div class="col-12">
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                <input type="hidden" name="project_id" value="{{ $id }}">

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{ Form::label('theme', __('Theme'),['class'=>'form-control-label']) }}

                                    {{ Form::text('theme', '', array('class' => 'form-control', 'required'=>'required')) }}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('price_per_hours', __('Price per hours'),['class'=>'form-control-label']) }}

                                    {{ Form::number('price_per_hours', '', array('class' => 'form-control')) }}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('cost', __('Costo'),['class'=>'form-control-label']) }}

                                    {{ Form::number('cost', '', array('class' => 'form-control')) }}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('date_start', __('Date start'),['class'=>'form-control-label']) }}

                                    {{ Form::text('date_start', '', array('class' => 'form-control datepicker', 'required'=>'required')) }}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('date_end', __('Date end'),['class'=>'form-control-label']) }}

                                    {{ Form::text('date_end', '', array('class' => 'form-control datepicker')) }}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('assign_to', __('Assign to'),['class'=>'form-control-label']) }}

                                    {{ Form::select('assign_to[]', $members, null, array('multiple' => 'multiple', 'class' => 'select2 form-control','id'=>'assign_to')) }}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('priority', __('Priority'),['class'=>'form-control-label']) }}

                                    {{ Form::select('priority', $priorities, null, array('class' => 'select2 form-control','id'=>'priority')) }}
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    {{ Form::label('description', __('Description'),['class'=>'form-control-label']) }}

                                    {{ Form::textarea('description', '', ['class' => 'form-control']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 text-right">
                <input type="submit" value="{{__('Create')}}" class="btn-create btn-xs badge-blue radius-10px">
                <input type="button" value="{{__('Cancel')}}" onclick="location.href = '{{route("contracts.index")}}';" class="btn-create btn-xs bg-gray radius-10px">
            </div>
        </div>
    {{ Form::close() }}
@endsection


