@extends('dashboard.layouts.index')
@section('css')
@toastr_css
@endsection
@section('content')
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="card-body">
                    <div class="tab nav-border">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active show" id="home-02-tab" data-toggle="tab" href="#home-02"
                                    role="tab" aria-controls="home-02"
                                    aria-selected="true">{{__('project details')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-02-tab" data-toggle="tab" href="#profile-02" role="tab"
                                    aria-controls="profile-02" aria-selected="false">{{__('Attachments')}}</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="home-02" role="tabpanel"
                                aria-labelledby="home-02-tab">
                                <table class="table table-striped table-hover" style="text-align:center">
                                    <tbody>
                                        <tr>
                                            <th scope="row">{{__('Name')}}</th>
                                            <td>{{ $project->name }}</td>
                                            <th scope="row">{{__('Requirements Name')}}</th>
                                            <td>{{$project->requirements_name}}</td>
                                            <th scope="row">{{__('Start Date')}}</th>
                                            <td>{{$project->start_date}}</td>
                                            <th scope="row">{{__('End Date')}}</th>
                                            <td>{{$project->end_date}}</td>
                                        </tr>

                                        <tr>
                                            <th scope="row">{{__('Price')}}</th>
                                            <td>{{ $project->price }}</td>
                                            <th scope="row">{{__('Client')}}</th>
                                            <td>{{$project->client->name}}</td>
                                            <th scope="row">{{__('Description')}}</th>
                                            <td>{{$project->description}}</td>
                                            <th scope="row">{{__('status')}}</th>
                                            <td>{{ $project->getActive()}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="tab-pane fade" id="profile-02" role="tabpanel" aria-labelledby="profile-02-tab">
                                <div class="card card-statistics">
                                    <div class="card-body">
                                        <form method="post" action="{{route('upload_attachment')}}"
                                            enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="academic_year">{{__('Attachments')}}
                                                        : <span class="text-danger">*</span></label>
                                                    <input type="file" accept="image/*" name="photos[]" multiple
                                                        required>
                                                    <input type="hidden" name="project_name" value="{{$project->name}}">
                                                    <input type="hidden" name="project_id" value="{{$project->id}}">
                                                </div>
                                            </div>
                                            <br><br>
                                            <button type="submit" class="button button-border x-small">
                                                {{__('submit')}}
                                            </button>
                                        </form>
                                    </div>
                                    <br>
                                    <table class="table center-aligned-table mb-0 table table-hover"
                                        style="text-align:center">
                                        <thead>
                                            <tr class="table-secondary">
                                                <th scope="col">#</th>
                                                <th scope="col">{{__('filename')}}</th>
                                                <th scope="col">{{__('created_at')}}</th>
                                                <th scope="col">{{__('Processes')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($project->images as $attachment)
                                            <tr style='text-align:center;vertical-align:middle'>
                                                <td>{{$loop->iteration}}</td>
                                                <td><img src="{{URL::asset('attachments/projects/'.$attachment->imageable->name.'/'.$attachment->filename)}}"
                                                     alt=""  height="50px" width="50px"></td>
                                                <td>{{$attachment->created_at->diffForHumans()}}</td>
                                                <td colspan="2">
                                                    <a class="btn btn-outline-info btn-sm"
                                                        href="{{url('admin/download_attachment')}}/{{ $attachment->imageable->name }}/{{$attachment->filename}}"
                                                        role="button"><i class="fas fa-download"></i>&nbsp;
                                                        {{__('Download')}}</a>

                                                    <button type="button" class="btn btn-outline-danger btn-sm"
                                                        data-toggle="modal"
                                                        data-target="#Delete_img{{ $attachment->id }}"
                                                        title="{{ __('Delete') }}">{{__('delete')}}
                                                    </button>

                                                </td>
                                            </tr>
                                            @include('dashboard.pages.project.delete_img')
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
@toastr_js
@toastr_render
@endsection
