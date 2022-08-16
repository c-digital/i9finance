@extends('layouts.admin')


@php
    $profile=asset(Storage::url('uploads/avatar/'));
@endphp


@section('page-title')
    {{__('Files')}}
@endsection


@push('css-page')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush


@push('script-page')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $('.dropify').dropify();
    </script>
@endpush


@section('content')
    <div class="row">
        <div class="col-md-12">
            <form method="POST" action="{{ "/projects/$project->id/files" }}" enctype="multipart/form-data">
                <input type="hidden" name="project_id" value="{{ $project->id }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <input type="file" name="files[]" multiple class="dropify">

                <input type="submit" value="{{__('Upload')}}" class="btn-create badge-blue">
            </form>

            <div class="card mt-4">
                <div class="card-body py-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0 dataTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Name')}}</th>
                                <th>{{ __('Type')}}</th>
                                <th>{{ __('Upload by')}}</th>
                                <th>{{ __('Date')}}</th>
                            </tr>
                            </thead>

                            <tbody>
                                @foreach($project->files as $file)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $file->name }}</td>
                                        <td>{{ $file->type }}</td>
                                        <td>{{ $file->user->name }}</td>
                                        <td>{{ $file->date_upload }}</td>
                                        <td>
                                            @include('files.comments')

                                            <a href="{{ "/projects/{$project->id}/files/{$file->id}/download" }}" class="edit-icon bg-success">
                                                <i class="fas fa-download"></i>
                                            </a>

                                            <a href="#" class="delete-icon " data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{ $project->id}}').submit();">
                                                    <i class="fas fa-trash"></i>
                                                </a>

                                            {!! Form::open(['method' => 'DELETE', 'route' => ['projects.destroy', $project->id],'id'=>'delete-form-'.$project->id]) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

