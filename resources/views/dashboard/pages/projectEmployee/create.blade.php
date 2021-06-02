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
                <form action="{{route('embloyeeProjects.store')}}" method="POST">
                    @csrf
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="inputCity">{{__('Embloyee')}}</label>
                        <select class="custom-select my-1 mr-sm-2" name="embloyee_id">
                            <option selected>{{__('Choose')}}...</option>
                            @foreach($embloyees as $embloyee)
                            <option value="{{$embloyee->id}}">{{$embloyee->name}}</option>
                            @endforeach
                        </select>
                        @error('embloyee_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="inputCity">{{__('Project')}}</label>
                        <select class="custom-select my-1 mr-sm-2" name="project_id">
                            <option selected>{{__('Choose')}}...</option>
                            @foreach($projects as $project)
                            <option value="{{$project->id}}">{{$project->name}}</option>
                            @endforeach
                        </select>
                        @error('project_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-4">
                        <label for="">{{ __('Type Job') }} :</label>
                        <input type="text" name="type_job"
                            class="form-control @error('type_job') is-invalid @enderror"
                            placeholder="{{__('Type Job')}}">
                        @error('type_job') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <br>

                <div class="modal-footer">
                    <a  class="btn btn-secondary" name="close">{{ __('Close') }}</a>
                   
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
