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
