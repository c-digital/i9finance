@extends('layouts.admin')

@php
    $profile=asset(Storage::url('uploads/avatar/'));
@endphp

@section('page-title')
    {{ $schedule->name }}
@endsection

@push('css-page')
    <style>
        td, .alert {
            cursor: pointer;
        }

        label {
            color: #808080;
        }
    </style>
@endpush

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
            $('[data-toggle="tooltip"]').tooltip();

            $('.event').click(function () {
                timestamp = $(this).attr('data-timestamp');

                $.ajax({
                    type: 'GET',
                    url: '/schedule-items/' + timestamp + '/edit',
                    success: function (response) {
                        $('#edit-event').find('[name=customer_id]').val(response.customer_id).change();
                        $('#edit-event').find('[name=service_id]').val(response.service_id).change();
                        $('#edit-event').find('[name=user_id]').val(response.user_id).change();
                        $('#edit-event').find('[name=status]').val(response.status).change();
                        $('#edit-event').find('[name=date_start]').val(response.date_start);
                        $('#edit-event').find('[name=date_end]').val(response.date_end);
                        $('#edit-event').find('[name=obs]').val(response.obs);
                        $('#edit-event').find('[name=comment]').val(response.comment);

                        $('#edit-event').find('.edit-form').attr('action', '/schedule-items/' + response.timestamp);

                        $('.btn-delete').attr('data-timestamp', response.timestamp);

                        $('#edit-event').modal('show');
                    },
                    error: function (error) {
                        $('body').html(error.responseText);
                    }
                });
            });



            $('#edit-event').on('hidden.bs.modal', function () {
                $('#create-event').modal('hide');
                $('.modal-backdrop').hide();
            });



            $('.cell').click(function () {
                content = $(this).html();
                content = content.trim();

                if (content) {
                    return false;
                }

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


            $('.btn-delete').click(function () {
                timestamp = $(this).attr('data-timestamp');
                $('.delete-form').attr('action', '/schedule-items/' + timestamp);
                $('.delete-form').submit();
            });
        });
    </script>
@endpush

@section('content')
    <div class="row">

        <div class="col-12">
            <form action="">
                <div class="row">
                    <div class="col-4"></div>

                    <div class="col-2">
                        <input name="date" type="date" class="form-control" value="{{ $_GET['date'] ?? date('Y-m-d') }}">
                    </div>

                    <div class="col-2">
                        <input type="submit" value="Ir a fecha" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>

        <hr>

        <div class="col-3">
            <div class="text-center alert alert-info">{{ __('Open') . ': ' . $totals->open }}</div>
        </div>

        <div class="col-3">
            <div class="text-center alert alert-primary">{{ __('In progress') . ': ' . $totals->in_progress }}</div>
        </div>

        <div class="col-3">
            <div class="text-center alert alert-success">{{ __('Finished') . ': ' . $totals->finished }}</div>
        </div>

        <div class="col-3">
            <div class="text-center alert alert-danger">{{ __('Cancelled') . ': ' . $totals->cancelled }}</div>
        </div>

        <hr>

        <div class="col-12">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center">
                            <a data-toggle="tooltip" data-placement="auto" title="Ir a la semana anterior" href="?date={{ $last }}">
                                <i class="fa fa-arrow-left"></i>
                            </a>
                        </th>

                        <th class="text-center"></th>

                        @foreach($weeks as $day)
                            <th class="text-center">
                                <span class="date-week" data-date="{{ $day['date'] }}">{{ $day['showDate'] }}</span> <br>
                                {{ __($day['day']) }}
                            </th>
                        @endforeach

                        <th class="text-center">
                            <a data-toggle="tooltip" data-placement="auto" title="Ir a la semana siguiente" href="?date={{ $next }}">
                                <i class="fa fa-arrow-right"></i>
                            </a>
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($hours as $hour)
                        <tr>
                            <td></td>
                            <td>{{ $hour }}</td>

                            <td class="text-center cell" data-hour="{{ $hour }}" data-td="1">
                                @php
                                    $date_start = $weeks[0]['date'] . ' ' . $hour . ':00';
                                    $item = App\ScheduleItem::where('date_start', $date_start)
                                        ->where('schedule_id', $schedule->id)
                                        ->first();

                                    if ($item) {
                                        $tooltip  = "Paciente: {$item->customer->name}</br>";
                                        $tooltip .= "Profesional: {$item->user->name}</br>";
                                        $tooltip .= "Servicio: {$item->service->name}</br>";
                                        $tooltip .= "OBS: {$item->obs}</br>";
                                        $tooltip .= "Comentario: {$item->comment}<br>";
                                        $tooltip .= "Fecha inicio: {$item->date_start}<br>";
                                        $tooltip .= "Fecha fin: {$item->end}";

                                        echo '<div data-toggle="tooltip" data-placement="auto" data-html="true" title="' . $tooltip . '" data-timestamp="' . $item->timestamp . '" class="event ' . $item->color.'">' . $item->customer->name . '</div>';
                                    }
                                @endphp
                            </td>

                            <td class="text-center cell" data-hour="{{ $hour }}" data-td="2">
                                @php
                                    $date_start = $weeks[1]['date'] . ' ' . $hour . ':00';
                                    $item = App\ScheduleItem::where('date_start', $date_start)
                                        ->where('schedule_id', $schedule->id)
                                        ->first();

                                    if ($item) {
                                        $tooltip  = "Paciente: {$item->customer->name}</br>";
                                        $tooltip .= "Profesional: {$item->user->name}</br>";
                                        $tooltip .= "Servicio: {$item->service->name}</br>";
                                        $tooltip .= "OBS: {$item->obs}</br>";
                                        $tooltip .= "Comentario: {$item->comment}<br>";
                                        $tooltip .= "Fecha inicio: {$item->date_start}<br>";
                                        $tooltip .= "Fecha fin: {$item->end}";

                                        echo '<div data-toggle="tooltip" data-placement="auto" data-html="true" title="' . $tooltip . '" data-timestamp="' . $item->timestamp . '" class="event ' . $item->color.'">' . $item->customer->name . '</div>';
                                    }
                                @endphp
                            </td>

                            <td class="text-center cell" data-hour="{{ $hour }}" data-td="3">
                                @php
                                    $date_start = $weeks[2]['date'] . ' ' . $hour . ':00';
                                    $item = App\ScheduleItem::where('date_start', $date_start)
                                        ->where('schedule_id', $schedule->id)
                                        ->first();

                                    if ($item) {
                                        $tooltip  = "Paciente: {$item->customer->name}</br>";
                                        $tooltip .= "Profesional: {$item->user->name}</br>";
                                        $tooltip .= "Servicio: {$item->service->name}</br>";
                                        $tooltip .= "OBS: {$item->obs}</br>";
                                        $tooltip .= "Comentario: {$item->comment}<br>";
                                        $tooltip .= "Fecha inicio: {$item->date_start}<br>";
                                        $tooltip .= "Fecha fin: {$item->end}";

                                        echo '<div data-toggle="tooltip" data-placement="auto" data-html="true" title="' . $tooltip . '" data-timestamp="' . $item->timestamp . '" class="event ' . $item->color.'">' . $item->customer->name . '</div>';
                                    }
                                @endphp
                            </td>

                            <td class="text-center cell" data-hour="{{ $hour }}" data-td="4">
                                @php
                                    $date_start = $weeks[3]['date'] . ' ' . $hour . ':00';
                                    $item = App\ScheduleItem::where('date_start', $date_start)
                                        ->where('schedule_id', $schedule->id)
                                        ->first();

                                    if ($item) {
                                        $tooltip  = "Paciente: {$item->customer->name}</br>";
                                        $tooltip .= "Profesional: {$item->user->name}</br>";
                                        $tooltip .= "Servicio: {$item->service->name}</br>";
                                        $tooltip .= "OBS: {$item->obs}</br>";
                                        $tooltip .= "Comentario: {$item->comment}<br>";
                                        $tooltip .= "Fecha inicio: {$item->date_start}<br>";
                                        $tooltip .= "Fecha fin: {$item->end}";

                                        echo '<div data-toggle="tooltip" data-placement="auto" data-html="true" title="' . $tooltip . '" data-timestamp="' . $item->timestamp . '" class="event ' . $item->color.'">' . $item->customer->name . '</div>';
                                    }
                                @endphp
                            </td>

                            <td class="text-center cell" data-hour="{{ $hour }}" data-td="5">
                                @php
                                    $date_start = $weeks[4]['date'] . ' ' . $hour . ':00';
                                    $item = App\ScheduleItem::where('date_start', $date_start)
                                        ->where('schedule_id', $schedule->id)
                                        ->first();

                                    if ($item) {
                                        $tooltip  = "Paciente: {$item->customer->name}</br>";
                                        $tooltip .= "Profesional: {$item->user->name}</br>";
                                        $tooltip .= "Servicio: {$item->service->name}</br>";
                                        $tooltip .= "OBS: {$item->obs}</br>";
                                        $tooltip .= "Comentario: {$item->comment}<br>";
                                        $tooltip .= "Fecha inicio: {$item->date_start}<br>";
                                        $tooltip .= "Fecha fin: {$item->end}";

                                        echo '<div data-toggle="tooltip" data-placement="auto" data-html="true" title="' . $tooltip . '" data-timestamp="' . $item->timestamp . '" class="event ' . $item->color.'">' . $item->customer->name . '</div>';
                                    }
                                @endphp
                            </td>

                            <td class="text-center cell" data-hour="{{ $hour }}" data-td="6">
                                @php
                                    $date_start = $weeks[5]['date'] . ' ' . $hour . ':00';
                                    $item = App\ScheduleItem::where('date_start', $date_start)
                                        ->where('schedule_id', $schedule->id)
                                        ->first();

                                    if ($item) {
                                        $tooltip  = "Paciente: {$item->customer->name}</br>";
                                        $tooltip .= "Profesional: {$item->user->name}</br>";
                                        $tooltip .= "Servicio: {$item->service->name}</br>";
                                        $tooltip .= "OBS: {$item->obs}</br>";
                                        $tooltip .= "Comentario: {$item->comment}<br>";
                                        $tooltip .= "Fecha inicio: {$item->date_start}<br>";
                                        $tooltip .= "Fecha fin: {$item->end}";

                                        echo '<div data-toggle="tooltip" data-placement="auto" data-html="true" title="' . $tooltip . '" data-timestamp="' . $item->timestamp . '" class="event ' . $item->color.'">' . $item->customer->name . '</div>';
                                    }
                                @endphp
                            </td>

                            <td class="text-center cell" data-hour="{{ $hour }}" data-td="7">
                                @php
                                    $date_start = $weeks[6]['date'] . ' ' . $hour . ':00';
                                    $item = App\ScheduleItem::where('date_start', $date_start)
                                        ->where('schedule_id', $schedule->id)
                                        ->first();

                                    if ($item) {
                                        $tooltip  = "Paciente: {$item->customer->name}</br>";
                                        $tooltip .= "Profesional: {$item->user->name}</br>";
                                        $tooltip .= "Servicio: {$item->service->name}</br>";
                                        $tooltip .= "OBS: {$item->obs}</br>";
                                        $tooltip .= "Comentario: {$item->comment}<br>";
                                        $tooltip .= "Fecha inicio: {$item->date_start}<br>";
                                        $tooltip .= "Fecha fin: {$item->end}";

                                        echo '<div data-toggle="tooltip" data-placement="auto" data-html="true" title="' . $tooltip . '" data-timestamp="' . $item->timestamp . '" class="event ' . $item->color.'">' . $item->customer->name . '</div>';
                                    }
                                @endphp
                            </td>

                            <td></td>
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
                            <label for="user_id">{{ __('Professional') }}</label>
                            <select required name="user_id" class="form-control select2">
                                <option value=""></option>

                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="service_id">{{ __('Service') }}</label>
                            <select required name="service_id" class="form-control select2">
                                <option value=""></option>

                                @foreach($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="obs">{{ __('OBS') }}</label>
                            <input type="text" name="obs" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="comment">{{ __('Comment') }}</label>
                            <input type="text" name="comment" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="date_start">{{ __('Date start') }}</label>
                            <input required type="datetime-local" step="900" name="date_start" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="date_end">{{ __('Date end') }}</label>
                            <input required type="datetime-local" step="900" name="date_end" class="form-control">
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

    <div class="modal" id="edit-event" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="background-color: white;">
                <div class="modal-header">
                    <h5 class="modal-title">Editar evento</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="" class="edit-form" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">

                    <div class="modal-body p-4">
                        <div class="row">
                            <div class="col-12">
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
                                    <label for="user_id">{{ __('Professional') }}</label>
                                    <select required name="user_id" class="form-control select2">
                                        <option value=""></option>

                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="service_id">{{ __('Service') }}</label>
                                    <select required name="service_id" class="form-control select2">
                                        <option value=""></option>

                                        @foreach($services as $service)
                                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="date_start">{{ __('Date start') }}</label>
                                    <input required type="datetime-local" step="900" name="date_start" class="form-control">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="date_end">{{ __('Date end') }}</label>
                                    <input required type="datetime-local" step="900" name="date_end" class="form-control">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="obs">{{ __('OBS') }}</label>
                                    <input type="text" name="obs" class="form-control">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="comment">{{ __('Comment') }}</label>
                                    <input type="text" name="comment" class="form-control">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="status">{{ __('Status') }}</label>
                                    <select required name="status" class="form-control">
                                        <option value=""></option>
                                        <option value="open">{{ __('Open') }}</option>
                                        <option value="in progress">{{ __('In progress') }}</option>
                                        <option value="finished">{{ __('Finished') }}</option>
                                        <option value="cancelled">{{ __('Cancelled') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <a href="#" class="btn-delete btn btn-danger">Eliminar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <form action="" method="POST" class="delete-form">
        @csrf
        @method('DELETE')
    </form>
@endsection
