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
                                    <a href="{{route('embloyeeProjects.create')}}" class="btn btn-success btn-sm btn-lg pull-right" name="projectEmbloyee"
                                        type="submit">{{ __('create projectEmbloyee') }}</a><br><br>
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
                                                        <th class="wd-20p border-bottom-0">{{ __('Employee') }}</th>
                                                        <th class="wd-15p border-bottom-0">{{ __('Project') }}</th>
                                                        <th class="wd-15p border-bottom-0">{{ __('Type Jobe') }}</th>
                                                        <th>{{ __('Processes') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @isset($embloyeeProjects)
                                                    @foreach ($embloyeeProjects as $embloyeeProject)

                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{ $embloyeeProject->employee->name }}</td>
                                                        <td>{{ $embloyeeProject->project->name }}</td>
                                                        <td>{{ $embloyeeProject->type_job }}</td>
                                                        <td>
                                                            <a class="modal-effect btn btn-sm btn-info"
                                                                href="{{route('embloyeeProjects.edit',$embloyeeProject->id)}}"
                                                                style="margin-left: 5px"><i class="las la-pen"></i></a>

                                                            <a class="modal-effect btn btn-sm btn-danger"
                                                                data-effect="effect-scale" data-toggle="modal"
                                                                href="#delete{{$embloyeeProject->id}}"><i
                                                                    class="las la-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                    <!-- delete_modal_embloyeeProject -->
                                                    @include('dashboard.pages.projectEmployee.delete')
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
