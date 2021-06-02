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
                                    <a href="{{route('paymentClients.create')}}" class="btn btn-success btn-sm btn-lg pull-right" name="PaymentClient"
                                        type="submit">{{ __('create paymentClient') }}</a><br><br>
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
                                                        <th class="wd-20p border-bottom-0">{{ __('Client') }}</th>
                                                        <th class="wd-15p border-bottom-0">{{ __('Project') }}</th>
                                                        <th class="wd-15p border-bottom-0">{{ __('Price') }}</th>
                                                        <th class="wd-15p border-bottom-0">{{ __('Batch Price') }}</th>
                                                        <th class="wd-15p border-bottom-0">{{ __('Rest of Batch') }}
                                                        </th>
                                                        <th class="wd-15p border-bottom-0">{{ __('Payment') }}</th>
                                                        <th>{{ __('Processes') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   
                                                    @isset($paymentClients)
                                                    @foreach ($paymentClients as $paymentClient)
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{$paymentClient->client->name}}</td>
                                                        <td>{{ $paymentClient->project->name }}</td>
                                                        <td>{{ $paymentClient->project->price }}</td>
                                                        <td>{{ $paymentClient->rest_of_batch }}</td>
                                                        <td>{{ $paymentClient->batch_price }}</td>
                                                        <td>{{ $paymentClient->payments }}</td>

                                                        <td>
                                                            <a class="modal-effect btn btn-sm btn-info"
                                                                href="{{route('paymentClients.edit',$paymentClient->id)}}"
                                                                style="margin-left: 5px"><i class="las la-pen"></i></a>

                                                            <a class="modal-effect btn btn-sm btn-danger"
                                                                data-effect="effect-scale" data-toggle="modal"
                                                                href="#delete{{$paymentClient->id}}"><i
                                                                    class="las la-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                    <!-- delete_modal_ paymentClient-->
                                                    {{-- @include('dashboard.pages.payment.delete') --}}

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
