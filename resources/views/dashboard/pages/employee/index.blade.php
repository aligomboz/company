@extends('dashboard.layouts.index')
@section('css')
@toastr_css
@endsection
@section('content')
<div class="row">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="col-lg-12 col-md-12">
        <div class="card" id="basic-alert">
            <div class="card-body">
                <div class="text-wrap">
                    <div class="example">
                        <div class="panel panel-primary tabs-style-1">
                            <div class="tab-menu-heading">
                                <div class="tabs-menu1">
                                    <!-- Tabs -->
                                    <a href="{{route('employees.create')}}" class="btn btn-success btn-sm btn-lg pull-right" name="createEmployee"
                                        type="submit">{{ __('create employee') }}</a><br><br>
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
                                                        <th class="wd-15p border-bottom-0">{{ __('Phone') }}</th>
                                                        <th class="wd-15p border-bottom-0">{{ __('email') }}</th>
                                                        <th class="wd-15p border-bottom-0">{{ __('Start Job') }}</th>
                                                        <th class="wd-15p border-bottom-0">{{ __('End Jobg') }}</th>
                                                        <th class="wd-15p border-bottom-0">{{ __('Contract') }}</th>
                                                        <th class="wd-15p border-bottom-0">{{ __('Sallary') }}</th>
                                                        <th class="wd-15p border-bottom-0">{{ __('Description') }}</th>
                                                        <th class="wd-15p border-bottom-0">{{ __('Status') }}</th>

                                                        <th>{{ __('Processes') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @isset($employees)
                                                    @foreach ($employees as $employee)
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{ $employee->name}}</td>
                                                        <td>{{ $employee->phone}}</td>
                                                        <td>{{ $employee->email}}</td>
                                                        <td>{{ $employee->start_job}}</td>
                                                        <td>{{ $employee->end_job}}</td>
                                                        <td>{{ $employee->contract}}</td>
                                                        <td>{{ $employee->sallary}}</td>
                                                        <td>{{ $employee->description}}</td>
                                                        <td>{{ $employee->getActive()}}</td>

                                                        <td>
                                                            <a class="modal-effect btn btn-sm btn-info"
                                                                href="{{route('employees.edit',$employee->id)}}"
                                                                style="margin-left: 5px"><i class="las la-pen"></i></a>

                                                            <a class="modal-effect btn btn-sm btn-danger"
                                                                data-effect="effect-scale" data-toggle="modal"
                                                                href="#delete{{$employee->id}}"><i
                                                                    class="las la-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                    <!-- delete_modal_employee -->
                                                   @include('dashboard.pages.employee.delete')
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