@extends('dashboard.layouts.index')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body">
                <form action="{{route('employees.update',$employee->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="employee_id" value="{{$employee->id}}">
                    <div class="row">
                        <div class="col-4">
                            <label for="">{{ __('Name') }} :</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                placeholder="{{__('name')}}" value="{{$employee->name}}">
                            @error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-4">
                            <label for="">{{ __('Phone') }} :</label>
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                placeholder="{{__('phone')}}" value="{{$employee->phone}}">
                            @error('phone') <span class="error text-danger">{{ $message }}</span> @enderror

                        </div>
                        <div class="col-4">
                            <label for="">{{ __('Email') }} :</label>
                            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                                placeholder="{{__('email')}}" value="{{$employee->email}}">
                            @error('email') <span class="error text-danger">{{ $message }}</span> @enderror

                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-6">
                            <label for="">{{ __('Start Job') }} :</label>
                            <input type="date" name="start_job"
                                class="form-control @error('start_job') is-invalid @enderror"
                                placeholder="{{__('start_job')}}" value="{{$employee->start_job}}">
                            @error('start_job') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-6">
                            <label for="">{{ __('End Job') }} :</label>
                            <input type="date" name="end_job"
                                class="form-control @error('end_job') is-invalid @enderror"
                                placeholder="{{__('end_job')}}" value="{{$employee->end_job}}">
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
                                <option selected value="{{$con}}">{{$con}}</option>
                                @endforeach
                                {{-- {{dd($cont)}} --}}
                            </select>
                            @error('contract') <span class="error text-danger">{{ $message }}</span> @enderror

                        </div>
                        <div class="col-6">
                            <label for="">{{ __('Sallary') }} :</label>
                            <input type="string" name="sallary"
                                class="form-control @error('sallary') is-invalid @enderror"
                                placeholder="{{__('Sallary')}}" value="{{$employee->sallary}}">
                            @error('sallary') <span class="error text-danger">{{ $message }}</span> @enderror

                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-12">
                            <label for="">{{ __('Description') }} :</label>
                            <textarea name="description" id="" cols="30" rows="5" class="form-control">{{$employee->name}}</textarea>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mt-1">
                                @if ($employee->is_active === 1)
                                <input type="checkbox" checked class="form-check-input" name="is_active"
                                    id="exampleCheck1" value="{{$employee->is_active}}">
                                @else
                                <input type="checkbox" class="form-check-input" name="is_active" id="exampleCheck1">
                                @endif
                                <label for="switcheryColor4" class="card-title ml-1">{{__('Status')}}
                                </label>
                                @error("is_active")
                                <span class="error text-danger">{{$message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <br>


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
