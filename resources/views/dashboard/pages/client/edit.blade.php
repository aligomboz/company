@extends('dashboard.layouts.index')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body">
                <form action="{{route('clients.update',$client->id)}}" method="POST">
                    <input type="hidden" name="client_id" value="{{$client->id}}">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-6">
                            <label for="">{{ __('Name') }} :</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                placeholder="{{__('Name')}}" value="{{$client->name}}">
                            @error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-6">
                            <label for="">{{ __('Phone') }} :</label>
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                placeholder="{{__('Phone')}}" value="{{$client->phone}}">
                            @error('phone') <span class="error text-danger">{{ $message }}</span> @enderror

                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-6">
                            <label for="">{{ __('Email') }} :</label>
                            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                                placeholder="{{__('Email')}}" value="{{$client->email}}">
                            @error('email') <span class="error text-danger">{{ $message }}</span> @enderror

                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputCity">{{__('Access Methods')}}</label>
                            <select class="custom-select my-1 mr-sm-2" name="AccessMethods">
                                <option selected>{{__('Choose')}}...</option>
                                @foreach($access_methods as $AccessMethod)
                                <option selected value="{{$AccessMethod}}">{{$AccessMethod}}</option>
                                @endforeach
                                {{-- {{dd($cont)}} --}}
                            </select>
                            @error('AccessMethods') <span class="error text-danger">{{ $message }}</span> @enderror

                        </div>

                    </div>
                    <br>
                    <div class="row">
                        <div class="col-12">
                            <label for="">{{ __('Note') }} :</label>
                            <textarea name="note" id="" cols="30" rows="5" class="form-control">{{$client->note}}"</textarea>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mt-1">
                                @if ($client->is_active === 1)
                                <input type="checkbox" checked
                                    class="form-check-input"
                                    name="is_active"
                                    id="exampleCheck1" value="{{$client->is_active}}">
                                @else
                                <input type="checkbox"
                                    class="form-check-input"
                                    name="is_active"
                                    id="exampleCheck1">
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
                        <a href="{{route('clients.index')}}" class="btn btn-secondary">{{ __('Close') }}</a>
                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<!-- row closed -->

@endsection
