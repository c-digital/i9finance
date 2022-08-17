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
                date = $('.date-week').eq(td).text();

                $('#create-event').modal('show');
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

                        <th class="text-center">
                            <span class="date-week">{{ $carbon->startOfWeek()->format('d/m/Y') }}</span> <br>
                            {{ __($carbon->startOfWeek()->format('l')) }}
                        </th>

                        @for($i = 1; $i <= 6; $i++)
                            @php
                                $date = $carbon->addDay(1);
                            @endphp

                            <th class="text-center">
                                <span class="date-week">{{ $date->format('d/m/Y') }}</span> <br>
                                {{ __($date->format('l')) }}
                            </th>
                        @endfor
                    </tr>
                </thead>

                <tbody>
                    @foreach($hours as $hour)
                        <tr>
                            <td>{{ $hour }}</td>
                            <td class="text-center cell" data-hour="{{ $hour }}" data-td="1"></td>
                            <td class="text-center cell" data-hour="{{ $hour }}" data-td="2"></td>
                            <td class="text-center cell" data-hour="{{ $hour }}" data-td="3"></td>
                            <td class="text-center cell" data-hour="{{ $hour }}" data-td="4"></td>
                            <td class="text-center cell" data-hour="{{ $hour }}" data-td="5"></td>
                            <td class="text-center cell" data-hour="{{ $hour }}" data-td="6"></td>
                            <td class="text-center cell" data-hour="{{ $hour }}" data-td="7"></td>
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
                        <input required type="datetime-local" name="date_start datepicker" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="date_end">{{ __('Date end') }}</label>
                        <input required type="datetime-local" name="date_end datepicker" class="form-control">
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@endsection
