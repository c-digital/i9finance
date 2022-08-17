@extends('layouts.admin')

@php
    $profile=asset(Storage::url('uploads/avatar/'));
@endphp

@section('page-title')
    {{ $schedule->name }}
@endsection

@push('script-page')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.2/main.js" integrity="sha256-cbWu30RZ0VQ5sBdqcxYa3S3nA+E1d/tkUcflycLQZ50=" crossorigin="anonymous"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('fullcalendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth'
            });
            calendar.render();
        });
    </script>
@endpush

@push('css-page')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.2/main.css" integrity="sha256-jLWPhwkAHq1rpueZOKALBno3eKP3m4IMB131kGhAlRQ=" crossorigin="anonymous">
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div id="fullcalendar"></div>
        </div>
    </div>
@endsection
