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
    </style>
@endpush


@section('content')
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <img width="30%" src="{{$logo.'/'.(isset($company_logo) && !empty($company_logo)?$company_logo:'logo.png')}}" alt="">ç

                            <hr>

                            <h5> {{ $contract->theme }} </h5>

                            <h6> {{ $contract->customer->name }} </h6>

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
    </div>
@endsection
