@extends('dashboard.layouts.index')
@section('css')
@toastr_css
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card" id="basic-alert">
            <div class="card-body">
                <div class="text-wrap">
                    <div class="example">
                        <div class="panel panel-primary tabs-style-1">
                            <div class="tab-menu-heading">
                                <div class="tabs-menu1">
                                    <!-- Tabs -->
                                    <a href="{{route('projects.create')}}"
                                        class="btn btn-success btn-sm btn-lg pull-right"
                                        type="submit">{{ __('create project') }}</a><br><br>
                                </div>
                            </div>
                            <div class="panel-body tabs-menu-body main-content-body-right border-top-0 border">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab1">
                                        <div class="table-responsive">
                                            <table class="table text-md-nowrap text-center" id="example1">
                                                <thead>
                                                    <tr>
                                                        <th class="wd-15p border-bottom-0">#</th>
                                                        <th class="wd-20p border-bottom-0">{{ __('Name') }}</th>
                                                        <th class="wd-15p border-bottom-0">{{ __('Requirements Name') }}
                                                        </th>
                                                        <th class="wd-15p border-bottom-0">{{ __('Start Date') }}</th>
                                                        <th class="wd-15p border-bottom-0">{{ __('End Date') }}</th>
                                                        <th class="wd-15p border-bottom-0">{{ __('Price') }}</th>
                                                        <th class="wd-15p border-bottom-0">{{ __('Client') }}</th>
                                                        <th class="wd-15p border-bottom-0">{{__('Status')}}</th>
                                                        <th>{{ __('Processes') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @isset($projects)
                                                    @foreach ($projects as $project)
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{ $project->name}}</td>
                                                        <td>{{ $project->requirements_name}}</td>
                                                        <td>{{ $project->start_date}}</td>
                                                        <td>{{ $project->end_date}}</td>
                                                        <td>{{ $project->price}}</td>
                                                        <td>{{ $project->client->name}}</td>
                                                        <td>{{$project->getActive()}}</td>
                                                        <td>
                                                            <a class="modal-effect btn btn-sm btn-info"
                                                                href="{{route('projects.edit',$project->id)}}"
                                                                style="margin-left: 5px"><i class="las la-pen"></i></a>

                                                            <a class="modal-effect btn btn-sm btn-danger"
                                                                data-effect="effect-scale" data-toggle="modal"
                                                                href="#delete{{$project->id}}"><i
                                                                    class="las la-trash"></i></a>

                                                            <a href="{{route('projects.show',$project->id)}}"
                                                                class="btn btn-warning btn-sm" role="button"
                                                                aria-pressed="true"><i class="far fa-eye"></i></a>
                                                        </td>
                                                    </tr>
                                                    <!-- delete_modal_project -->
                                                    <div class="modal fade" id="delete{{ $project->id }}" tabindex="-1"
                                                        role="dialog" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 style="font-family: 'Cairo', sans-serif;"
                                                                        class="modal-title" id="exampleModalLabel">
                                                                        {{ __('delete project') }}
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    {{ __('are sure of the deleting process ?') }}
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">{{ __('Close') }}</button>
                                                                        <button type="button"
                                                                            class="btn btn-danger btn-sm"
                                                                            wire:click="delete({{ $project->id }})"
                                                                            title="{{ __('Delete') }}"><i
                                                                                class="fa fa-trash"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    @endisset
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
    </div>
    <!-- row closed -->
</div>

@endsection
@section('js')
@toastr_js
@toastr_render
@endsection
