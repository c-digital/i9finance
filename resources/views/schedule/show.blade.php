@extends('layouts.admin')

@php
    $profile=asset(Storage::url('uploads/avatar/'));
@endphp

@section('page-title')
    {{ $schedule->name }}
@endsection

@section('action-button')
    <div>
        <select name="calendar" class="form-control">
            <option value=""></option>
            @foreach($schedules as $item)
                <option {{ $schedule->id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>  
            @endforeach
        </select>
    </div>
@endsection

@push('script-page')
    <script>
        $(document).ready(function () {
            $('.cell').click(function () {
                hour = $(this).attr('data-hour');
                td = $(this).attr('data-td');
                td = parseInt(td) - 1;
                date = $('.date-week').eq(td).attr('data-date');
                date_start = date + 'T' + hour;

                $.ajax({
                    type: 'POST',
                    url: '/getDateEnd',
                    data: {
                        date_start: date_start,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        $('[name=date_start]').val(date_start);
                        $('[name=date_end]').val(response);
                        $('#create-event').modal('show');
                    },
                    error: function (error) {
                        $('body').html(error.responseText);
                    }
                });
            });

            $('[name="calendar"]').change(function () {
                id = $(this).val();

                if (id) {
                    window.location.href = '/schedule/' + id;
                }
            });
        });
    </script>
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center"></th>

                        @foreach($weeks as $day)
                            <th class="text-center">
                                <span class="date-week" data-date="{{ $day['date'] }}">{{ $day['showDate'] }}</span> <br>
                                {{ __($day['day']) }}
                            </th>
                        @endforeach
                    </tr>
                </thead>

                <tbody>
                    @foreach($hours as $hour)
                        <tr>
                            <td>{{ $hour }}</td>

                            <td class="text-center cell" data-hour="{{ $hour }}" data-td="1">
                                @php
                                    $date_start = $weeks[0]['date'] . ' ' . $hour . ':00';
                                    $item = App\ScheduleItem::where('date_start', $date_start)->first();
                                    if ($item) {
                                        echo '<div class="' . $item->color.'">' . $item->customer->name . '</div>';
                                    }
                                @endphp
                            </td>

                            <td class="text-center cell" data-hour="{{ $hour }}" data-td="2">
                                @php
                                    $date_start = $weeks[1]['date'] . ' ' . $hour . ':00';
                                    $item = App\ScheduleItem::where('date_start', $date_start)->first();
                                    if ($item) {
                                        echo '<div class="' . $item->color.'">' . $item->customer->name . '</div>';
                                    }
                                @endphp
                            </td>

                            <td class="text-center cell" data-hour="{{ $hour }}" data-td="3">
                                @php
                                    $date_start = $weeks[2]['date'] . ' ' . $hour . ':00';
                                    $item = App\ScheduleItem::where('date_start', $date_start)->first();
                                    if ($item) {
                                        echo '<div class="' . $item->color.'">' . $item->customer->name . '</div>';
                                    }
                                @endphp
                            </td>

                            <td class="text-center cell" data-hour="{{ $hour }}" data-td="4">
                                @php
                                    $date_start = $weeks[3]['date'] . ' ' . $hour . ':00';
                                    $item = App\ScheduleItem::where('date_start', $date_start)->first();
                                    if ($item) {
                                        echo '<div class="' . $item->color.'">' . $item->customer->name . '</div>';
                                    }
                                @endphp
                            </td>

                            <td class="text-center cell" data-hour="{{ $hour }}" data-td="5">
                                @php
                                    $date_start = $weeks[4]['date'] . ' ' . $hour . ':00';
                                    $item = App\ScheduleItem::where('date_start', $date_start)->first();
                                    if ($item) {
                                        echo '<div class="' . $item->color.'">' . $item->customer->name . '</div>';
                                    }
                                @endphp
                            </td>

                            <td class="text-center cell" data-hour="{{ $hour }}" data-td="6">
                                @php
                                    $date_start = $weeks[5]['date'] . ' ' . $hour . ':00';
                                    $item = App\ScheduleItem::where('date_start', $date_start)->first();
                                    if ($item) {
                                        echo '<div class="' . $item->color.'">' . $item->customer->name . '</div>';
                                    }
                                @endphp
                            </td>

                            <td class="text-center cell" data-hour="{{ $hour }}" data-td="7">
                                @php
                                    $date_start = $weeks[6]['date'] . ' ' . $hour . ':00';
                                    $item = App\ScheduleItem::where('date_start', $date_start)->first();
                                    if ($item) {
                                        echo '<div class="' . $item->color.'">' . $item->customer->name . '</div>';
                                    }
                                @endphp
                            </td>
                        </tr>
                    @endforeach
                </tbody>       
            </table>
        </div>
    </div>

    <div class="modal" id="create-event" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="background-color: white;">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar evento</h5>
                    
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="/schedule-items" method="POST">
                    @csrf

                    <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">

                    <div class="modal-body p-4">
                        <div class="form-group">
                            <label for="customer_id">{{ __('Customer') }}</label>
                            <select required name="customer_id" class="form-control select2">
                                <option value=""></option>

                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="product_id">{{ __('Product') }}</label>
                            <select required name="product_id" class="form-control select2">
                                <option value=""></option>

                                @foreach($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="date_start">{{ __('Date start') }}</label>
                            <input required type="datetime-local" name="date_start" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="date_end">{{ __('Date end') }}</label>
                            <input required type="datetime-local" name="date_end" class="form-control">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
