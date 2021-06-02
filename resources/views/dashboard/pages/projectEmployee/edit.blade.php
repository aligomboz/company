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
                <form action="{{route('embloyeeProjects.update',$embloyeeProject->id)}}" method="POST">
                    @csrf
                    @method('put')
                    <div class="row">
                        <input type="hidden" name="id" value="{{$embloyeeProject->id}}">
                        <div class="form-group col-md-4">
                            <label for="inputCity">{{__('Embloyee')}}</label>
                            <select class="custom-select my-1 mr-sm-2" name="embloyee_id">
                                <option selected>{{__('Choose')}}...</option>
                                @foreach($embloyees as $embloyee)
                                <option value="{{$embloyee->id}}" {{$embloyee->id == $embloyeeProject->embloyee_id ? 'selected' : ""}}>{{ $embloyee->name }}</option>
                                @endforeach
                            </select>
                            @error('embloyee_id') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="inputCity">{{__('Project')}}</label>
                            <select class="custom-select my-1 mr-sm-2" name="project_id">
                                <option selected>{{__('Choose')}}...</option>
                                @foreach($projects as $project)
                                <option value="{{$project->id}}" {{$project->id == $embloyeeProject->project_id ? 'selected' : ""}}>{{ $project->name }}</option>
                                @endforeach
                            </select>
                            @error('project_id') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-4">
                            <label for="">{{ __('Type Job') }} :</label>
                            <input type="text" name="type_job"
                                class="form-control @error('type_job') is-invalid @enderror"
                                placeholder="{{__('Type Job')}}" value="{{$embloyeeProject->type_job}}">
                            @error('type_job') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <br>

                    <div class="modal-footer">
                        <a class="btn btn-secondary" name="close">{{ __('Close') }}</a>

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
