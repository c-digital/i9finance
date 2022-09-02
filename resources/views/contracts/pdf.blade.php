<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <table style="width: 100%">
        <tbody>
            <tr>
                <td style="width: 70%">
                    <img style="margin-top: -180px" width="30%" src="{{ public_path() }}/uploads/logo.png" alt="">

                    <hr>

                    <h6> {{(Utility::getValByName('title_text')) ? Utility::getValByName('title_text') : config('app.name', 'AccountGo')}} </h6>

                    <hr>

                    @php
                        $keys = array_keys($vars);
                        $values = array_values($vars);

                        echo str_replace($keys, $values, $contract->content);
                    @endphp
                </td>

                <td style="width: 40%">
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
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>

