@extends('layouts.admin')


@section('page-title')
    {{__('Contract detail')}}
@endsection


@push('css-page')
    <style>
        #card-element {
            border: 1px solid #a3afbb !important;
            border-radius: 10px !important;
            padding: 10px !important;
        }

        .modal-dialog {
            background-color: white;
        }

        .modal-body {
            padding-right: 20px !important;
            padding-left: 20px !important;
        }
    </style>
@endpush


@section('content')
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <img width="30%" src="{{$logo.'/'.(isset($company_logo) && !empty($company_logo)?$company_logo:'logo.png')}}" alt="">

                            <hr>

                            <h5> {{ $contract->theme }} </h5>

                            <h6> {{(Utility::getValByName('title_text')) ? Utility::getValByName('title_text') : config('app.name', 'AccountGo')}} </h6>

                            <hr>

                            @php
                                $keys = array_keys($vars);
                                $values = array_values($vars);

                                echo str_replace($keys, $values, $contract->content);
                            @endphp
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card">
                <div class="card-body">

                    <a href="{{ '/contracts/pdf/' . $contract->id }}" class="btn btn-secondary btn-sm">
                        <i class="fa fa-file-pdf"></i> {{ __('Download') }}
                    </a>

                    @if($contract->sign)
                        <a href="#" class="btn btn-success btn-sm">
                            {{ __('Signed') }}
                        </a>
                    @else
                        <a href="" data-toggle="modal" data-target="#sign" class="btn btn-success btn-sm">
                            {{ __('Sign') }}
                        </a>
                    @endif

                    <hr>

                    <p><b>{{(Utility::getValByName('title_text')) ? Utility::getValByName('title_text') : config('app.name', 'AccountGo')}}</b></p>
                    <p>{{ Utility::getValByName('company_address') }}</p>
                    <p>{{ Utility::getValByName('company_cellphone') }}</p>
                    <p>{{ Utility::getValByName('company_city') }} {{ Utility::getValByName('company_state') }}</p>
                    <p>{{ Utility::getValByName('company_country') }} {{ Utility::getValByName('company_zipcode') }}</p>

                    <hr>

                    <p><b>{{ __('Amount') }}:</b> {{ $contract->amount }} </p>

                    <hr>

                    <p>#: {{ $contract->id }}</p>
                    <p>{{ __('Date start') }}: {{ $contract->date_start }}</p>
                    <p>{{ __('Type') }}: {{ $contract->type }}</p>

                    @if($contract->sign)
                        <hr>
                        
                        <p>{{ __('Name') }}: {{ json_decode($contract->sign)->name }}</p>
                        <p>{{ __('Date') }}: {{ json_decode($contract->sign)->date }}</p>
                        <p>{{ __('IP') }}: {{ json_decode($contract->sign)->ip }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="sign" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="/contracts/sign" method="POST">
                    <input type="hidden" name="id" value="{{ $contract->id }}">

                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title">Firmar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="email">{{ __('Email') }}</label>
                            <input type="email" clasS="form-control" name="email" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Firmar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
