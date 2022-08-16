@extends('layouts.admin')


@section('page-title')
    {{ __($project->name)}}
@endsection


@section('content')
    <ul class="mt-3 nav nav-pills">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="">
                <i class="fa fa-th"></i>
                {{ __('Description') }}
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ "/projects/$id/tasks" }}">
                <i class="fa fa-check-circle"></i>
                {{ __('Tasks') }}
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ "/projects/$id/files" }}">
                <i class="fa fa-copy"></i>
                {{ __('Files') }}
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ "/projects/$id/contracts" }}">
                <i class="fa fa-file"></i>
                {{ __('Contracts') }}
            </a>
        </li>
    </ul>

    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    {{ __('Resume') }}
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <p><b>#:</b> {{ $project->id }}</p>
                            <p><b>{{ __('Customer') }}:</b> {{ $project->customer->name }}</p>
                            <p><b>{{ __('Billing type') }}:</b> {{ __($project->billing_type) }}</p>
                            <p><b>{{ __('Total cost') }}:</b> {{ $project->total_cost }}</p>
                            <p><b>{{ __('Date start') }}:</b> {{ $project->date_start }}</p>
                            <p><b>{{ __('Date end') }}:</b> {{ $project->date_end }}</p>

                            <hr>

                            <p><b>{{ __('Description') }}</b></p>
                            <p>{{ $project->description }}</p>

                            <hr>

                            <p><b>{{ __('Members') }}</b></p>

                            @foreach($project->project_members as $member)
                                @php $user = App\User::find($member); @endphp

                                <p>
                                    <span class="avatar rounded-circle">
                                        <img style="width: 65%" src="{{ $user->avatar ? $user->avatar : '/storage/uploads/avatar/avatar.png' }}" alt="{{ $user->name }}">
                                    </span>

                                    {{ $user->name }}
                                </p>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
