@extends('dashboard.layouts.index')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body">
                <form action="{{route('employees.store')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-4">
                            <label for="">{{ __('Name') }} :</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                placeholder="{{__('name')}}">
                            @error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-4">
                            <label for="">{{ __('Phone') }} :</label>
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                placeholder="{{__('phone')}}">
                            @error('phone') <span class="error text-danger">{{ $message }}</span> @enderror

                        </div>
                        <div class="col-4">
                            <label for="">{{ __('Email') }} :</label>
                            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                                placeholder="{{__('email')}}">
                            @error('email') <span class="error text-danger">{{ $message }}</span> @enderror

                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-6">
                            <label for="">{{ __('Start Job') }} :</label>
                            <input type="date" name="start_job"
                                class="form-control @error('start_date') is-invalid @enderror"
                                placeholder="{{__('start_date')}}">
                            @error('start_date') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-6">
                            <label for="">{{ __('End Job') }} :</label>
                            <input type="date" name="end_job"
                                class="form-control @error('end_job') is-invalid @enderror"
                                placeholder="{{__('end_job')}}">
                            @error('end_job') <span class="error text-danger">{{ $message }}</span> @enderror

                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="inputCity">{{__('Contract')}}</label>
                            <select class="custom-select my-1 mr-sm-2" name="contract">
                                <option selected>{{__('Choose')}}...</option>
                                @foreach($cont as $con)
                                <option value="{{$con}}">{{$con}}</option>
                                @endforeach
                                {{-- {{dd($cont)}} --}}
                            </select>
                            @error('contract') <span class="error text-danger">{{ $message }}</span> @enderror

                        </div>
                        <div class="col-6">
                            <label for="">{{ __('Sallary') }} :</label>
                            <input type="string" name="sallary"
                                class="form-control @error('sallary') is-invalid @enderror"
                                placeholder="{{__('Sallary')}}">
                            @error('sallary') <span class="error text-danger">{{ $message }}</span> @enderror

                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-12">
                            <label for="">{{ __('Description') }} :</label>
                            <textarea name="description" id="" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                    <br>
                    {{-- <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mt-1">
                                <input type="checkbox" value="1" name="is_active" id="switcheryColor4" class="switchery"
                                    data-color="success" />
                                <label for="switcheryColor4" class="card-title ml-1">{{__('Status')}}
                                </label>
                                @error("is_active")
                                <span class="error text-danger">{{$message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <br> --}}


                    <div class="modal-footer">
                        <a href="{{route('employees.index')}}" class="btn btn-secondary"
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
