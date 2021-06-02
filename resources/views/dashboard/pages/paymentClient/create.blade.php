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
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="inputCity">{{__('Client')}}</label>
                        <select class="custom-select my-1 mr-sm-2" name="client" name="client_id">
                            <option selected>{{__('Choose')}}...</option>
                            @foreach($clients as $client)
                            <option value="{{$client->id}}">{{$client->name}}</option>
                            @endforeach
                        </select>
                        @error('client_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="inputCity">{{__('Project')}}</label>
                        <select class="custom-select my-1 mr-sm-2" name="project" name="project_id">
                            {{-- <option selected>{{__('Choose')}}...</option>  --}}
                            {{-- @foreach($projects as $project)
                            <option value="{{$project->id}}">{{$project->name}}</option>
                            @endforeach --}}
                        </select>
                        @error('project_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputCity">{{__('Price')}}</label>
                        <select class="custom-select my-1 mr-sm-2" name="price" name="project_id">
                            {{-- <option selected>{{__('Choose')}}...</option>
                            @foreach($projects as $project)
                            <option id="price" value="{{$project->id}}">{{$project->price}}</option>
                            @endforeach --}}
                        </select>
                        @error('project_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-4">
                        <label for="">{{ __('Batch Price') }} :</label>
                        <input type="string" name="batch_price"
                            class="form-control @error('batch_price') is-invalid @enderror"
                            placeholder="{{__('batch price')}}">
                        @error('batch_price') <span class="error text-danger">{{ $message }}</span> @enderror

                    </div>
                    <div class="col-4">
                        <label for="">{{ __('Rest of Batch') }} :</label>
                        <input onchange="myFunction()" type="string" name="rest_of_batch"
                            class="form-control @error('rest_of_batch') is-invalid @enderror"
                            placeholder="{{__('Rest of Batch')}}">
                        @error('rest_of_batch') <span class="error text-danger">{{ $message }}</span> @enderror

                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputCity">{{__('Payment')}}</label>
                        <select class="custom-select my-1 mr-sm-2" name="payments">
                            <option selected>{{__('Choose')}}...</option>
                            @foreach($payment as $payment)
                            <option value="{{$payment}}">{{$payment}}</option>
                            @endforeach
                        </select>
                        @error('payments') <span class="error text-danger">{{ $message }}</span> @enderror

                    </div>
                </div>
               
                <br>

                <div class="modal-footer">
                    <a href="{{route('paymentClients.index')}}" class="btn btn-secondary" name="close">{{ __('Close') }}</a>
                    
                    <button type="submit" class="btn btn-primary" name="submitForm">{{ __('Save') }}</button>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"
    integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        $('select[name="client"]').on('change', function () {
            var clientId = $(this).val();
            if (clientId) {
                $.ajax({
                    url: "{{ URL::to('admin/clientProject') }}/" + clientId,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="project"]').empty();
                        $.each(data, function (key, value) {
                            $('select[name="project"]').append(
                                '<option value="' +
                                key + '">' + value + '</option>');
                        });
                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
    $(document).ready(function () {
        $('select[name="project"]').on('change', function () {
            var projectId = $(this).val();
            if (projectId) {
                $.ajax({
                    url: "{{ URL::to('admin/projectPrice') }}/" + projectId,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="price"]').empty();
                        $.each(data, function (key, value) {
                            $('select[name="price"]').append(
                                '<option value="' +
                                key + '">' + value + '</option>');
                        });
                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
    function myFunction() {
        var price = parseFloat(document.getElementById("price").value);
        var batch_price = parseFloat(document.getElementById("batch_price").value);
        var Amount = price - batch_price;
        if (typeof price === 'undefined' || !price) {
            alert('Please enter the amount');
        } else {
            parseFloat(document.getElementById("rest_of_batch").value) = Amount;
        }
    }

</script>

<!-- row closed -->

@endsection
@section('js')

@endsection
