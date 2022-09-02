<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>{{(Utility::getValByName('title_text')) ? Utility::getValByName('title_text') : config('app.name', 'AccountGo')}} - @yield('page-title')</title>
    <link rel="icon" href="{{$logo.'/'.(isset($company_favicon) && !empty($company_favicon)?$company_favicon:'favicon.png')}}" type="image" sizes="16x16">

    <link rel="stylesheet" href="{{ asset('assets/libs/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/animate.css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-timepicker/css/bootstrap-timepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/select2/dist/css/select2.min.css') }}">

    @stack('css-page')

    <link rel="stylesheet" href="{{ asset('assets/css/site.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/ac.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/stylesheet.css') }}">

    @if(env('SITE_RTL')=='on')
        <link rel="stylesheet" href="{{ asset('css/bootstrap-rtl.css') }}">
    @endif

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.css" integrity="sha512-7uSoC3grlnRktCWoO4LjHMjotq8gf9XDFQerPuaph+cqR7JC9XKGdvN+UwZMC14aAaBDItdRj3DcSDs4kMWUgg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

    <div class="container mt-3 mb-3">
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
    </div>

    <script>
        window.print();
    </script>
</body>
</html>

