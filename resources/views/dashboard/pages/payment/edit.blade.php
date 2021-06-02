@extends('dashboard.layouts.index')
@section('css')

@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body">
                <form action="{{route('payments.update' , $payment->id)}}" method="POST">
                    @csrf
                    @method('put')
                    <input type="hidden" value="{{$payment->id}}" name="payment_id">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="inputCity">{{__('Embloyee')}}</label>
                            <select class="custom-select my-1 mr-sm-2" name="employee_id">
                                <option selected>{{__('Choose')}}...</option>
                                @foreach($employees as $embloyee)
                                <option value="{{$embloyee->id}}" {{$embloyee->id == $payment->employee_id ? 'selected' : ""}}>{{ $embloyee->name }}</option>
                                @endforeach
                            </select>
                            @error('embloyee_id') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputCity">{{__('Prject')}}</label>
                            <select class="custom-select my-1 mr-sm-2" name="project_id">
                                <option selected>{{__('Choose')}}...</option>
                                @foreach($projects as $project)
                                <option value="{{$project->id}}" {{$project->id == $payment->project_id ? 'selected' : ""}}>{{ $project->name }}</option>
                                @endforeach
                            </select>
                            @error('project_id') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-6">
                            <label for="">{{ __('Payment Cash') }} :</label>
                            <input type="string" name="payment_cash"
                                class="form-control @error('payment_cash') is-invalid @enderror"
                                placeholder="{{__('payment_cash')}}" value="{{$payment->payment_cash}}">
                            @error('payment_cash') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-6">
                            <label for="">{{ __('Remaining For Batch') }} :</label>
                            <input type="string" name="remaining_for_batch"
                                class="form-control @error('remaining_for_batch') is-invalid @enderror"
                                placeholder="{{__('Remaining For Batch')}}" value="{{$payment->remaining_for_batch}}">
                            @error('remaining_for_batch') <span class="error text-danger">{{ $message }}</span>
                            @enderror

                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="inputCity">{{__('Payment Methods')}}</label>
                            <select class="custom-select my-1 mr-sm-2" name="payment_methods">
                                <option selected>{{__('Choose')}}...</option>
                                @foreach($pay as $payment)
                                <option selected value="{{$payment}}">{{$payment}}</option>
                                @endforeach
                            </select>
                            @error('payment_methods') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>

                    </div>
                    <br>

                    <div class="modal-footer">
                        <a href="{{route('payments.index')}}" type="button" class="btn btn-secondary"
                            name="close">{{ __('Close') }}</a>
                        <button type="submit" class="btn btn-primary" name="submitForm">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<!-- row closed -->

@endsection
@section('js')

@endsection
