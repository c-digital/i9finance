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
    {{ Form::model($contract, array('route' => array('contracts.update', $contract->id), 'method' => 'PUT')) }}
        <div class="row">
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
                        <div>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-file-pdf"></i>
                                </button>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">Ver PDF</a>
                                    <a class="dropdown-item" href="#">Descargar</a>
                                    <a class="dropdown-item" href="#">Imprimir</a>
                                </div>
                            </div>

                            <a href="" class="btn btn-secondary">
                                <i class="fa fa-envelope"></i>
                            </a>
                        </div>

                        <hr>

                        <div>
                            <p>
                                <a class="" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                    {{ __('combination fields available') }}
                                </a>
                            </p>

                            <div class="collapse" id="collapseExample">
                                <div>
                                    <ul class="list-group">
                                        <li class="list-group-item"> {{ __('Name') }} [customer_name]</li>
                                        <li class="list-group-item"> {{ __('Contact') }} [customer_contact]</li>
                                        <li class="list-group-item"> {{ __('Email') }} [customer_email]</li>

                                        <li class="list-group-item"> {{ __('Name') }} [billing_name]</li>
                                        <li class="list-group-item"> {{ __('Country') }} [billing_country]</li>
                                        <li class="list-group-item"> {{ __('State') }} [billing_state]</li>
                                        <li class="list-group-item"> {{ __('City') }} [billing_city]</li>
                                        <li class="list-group-item"> {{ __('Phone') }} [billing_phone]</li>
                                        <li class="list-group-item"> {{ __('Zip Code') }} [billing_zipcode]</li>
                                        <li class="list-group-item"> {{ __('Address') }} [billing_address]</li>

                                        <li class="list-group-item"> {{ __('Name') }} [shipping_name]</li>
                                        <li class="list-group-item"> {{ __('Country') }} [shipping_country]</li>
                                        <li class="list-group-item"> {{ __('State') }} [shipping_state]</li>
                                        <li class="list-group-item"> {{ __('City') }} [shipping_city]</li>
                                        <li class="list-group-item"> {{ __('Phone') }} [shipping_phone]</li>
                                        <li class="list-group-item"> {{ __('Zip Code') }} [shipping_zipcode]</li>
                                        <li class="list-group-item"> {{ __('Address') }} [shipping_address]</li>

                                        <li class="list-group-item"> {{ __('Project') }} [project]</li>
                                        <li class="list-group-item"> {{ __('Theme') }} [theme]</li>
                                        <li class="list-group-item"> {{ __('Amount') }} [amount]</li>
                                        <li class="list-group-item"> {{ __('Type') }} [type]</li>
                                        <li class="list-group-item"> {{ __('Date start') }} [date_start]</li>
                                        <li class="list-group-item"> {{ __('Date end') }} [date_end]</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <textarea name="content" placeholder="Hacer click aquí para agregar contenido" class="form-control"></textarea>
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


