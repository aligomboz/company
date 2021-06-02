@extends('dashboard.layouts.index')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h2>{{__('Edit Project')}}</h2>
            </div>
            <div class="card-body">
                <form action="{{route('projects.update',$project->id)}}" method="POST">
                    @method('put')
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <label for="">{{ __('Name') }} :</label>
                            <input type="text" name="name"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="{{__('Name')}}" value="{{$project->name}}">
                            @error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-6">
                            <label for="">{{ __('equirements Name') }} :</label>
                            <input type="text" name="requirements_name"
                                class="form-control @error('requirements_name') is-invalid @enderror"
                                placeholder="{{__('requirements_name')}}"  value="{{$project->requirements_name}}">
                            @error('phone') <span class="error text-danger">{{ $message }}</span> @enderror

                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-6">
                            <label for="">{{ __('Start Date') }} :</label>
                            <input type="date" name="start_date"
                                class="form-control @error('start_date') is-invalid @enderror"
                                placeholder="{{__('start_date')}}"  value="{{$project->start_date}}">
                            @error('start_date') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-6">
                            <label for="">{{ __('End Date') }} :</label>
                            <input type="date" name="end_date"
                                class="form-control @error('end_date') is-invalid @enderror"
                                placeholder="{{__('end_date')}}"  value="{{$project->end_date}}">
                            @error('end_date') <span class="error text-danger">{{ $message }}</span> @enderror

                        </div>
                    </div>
                    <br>
        
                    <div class="row">
                        <div class="col-6">
                            <label for="">{{ __('Price') }} :</label>
                            <input type="text" name="price"
                                class="form-control @error('price') is-invalid @enderror" placeholder="{{__('price')}}"  value="{{$project->price}}">
                            @error('price') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputCity">{{__('Client')}}</label>
                            <select class="custom-select my-1 mr-sm-2" name="client_id">
                                <option>{{__('Choose')}}...</option>
                                @foreach($clients as $client)
                                <option value="{{$client->id}}" {{$client->id == $project->client_id ? 'selected':''}}>{{$client->name}}</option>
                                @endforeach
                            </select>
                            @error('client_id') <span class="error text-danger">{{ $message }}</span> @enderror

                        </div>
                    </div>
                    <br>
                   
                    <div class="row">
                        <div class="col-12">
                            <label for="">{{ __('Description') }} :</label>
                            <textarea name="description" id="" cols="30" rows="5" class="form-control">{{$project->description}}</textarea>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mt-1">
                                @if ($project->is_active === 1)
                                <input type="checkbox" checked
                                    class="form-check-input"
                                    name="is_active"
                                    id="exampleCheck1" value="{{$project->is_active}}">
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
                        <a href="{{route('projects.index')}}" class="btn btn-secondary">{{ __('Close') }}</a>
                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<!-- row closed -->

@endsection
