@extends('layouts.master')
@section('css')
<!-- Internal Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<!--Internal  Datetimepicker-slider css -->
<link href="{{URL::asset('assets/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/pickerjs/picker.min.css')}}" rel="stylesheet">
<!-- Internal Spectrum-colorpicker css -->
<link href="{{URL::asset('assets/plugins/spectrum-colorpicker/spectrum.css')}}" rel="stylesheet">
<style>
    select {
    -moz-appearance:none; /* Firefox */
    -webkit-appearance:none; /* Safari and Chrome */
    appearance:none;
}
</style>
@endsection
@section('title')
Food database - Edit Food Item
@stop
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
{{-- store errors --}}
@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<!-- row -->
<div class="row">

    <div class="col-xl-12">
        <div class="card mg-b-20">
            <form action="{{route('foods.update', $food->id)}}" method="post" class="needs-validation was-validated">
                @method('put')
                @csrf
                <div class="card-header pb-0 mb-3">
                    <h4 class=" text-muted">Name:</h4>
                    <div class="form-group has-success mg-b-0">
                        <input class="form-control" placeholder="Enter Food Name" name="name"  value="{{$food->name}}" type="text" required>
                    </div> 
                </div>
                <div class="card-body row">
                    <div class="col" style="height: 50vh; overflow:scroll">
                        {{-- diet --}}
                        <h3>Diet Ratings</h3>
                        <table>
                            @foreach ($food->diets as $diet)
                            <tr>
                                <td><input  data-id="{{ $diet->id }}" type="checkbox"  class="diet-enable mr-1" checked></td>
                                <td>{{ $diet->name }}</td>
                                <td>
                                    <select class="diet_rate  form-control select2-no-search ml-4" data-id="{{ $diet->id }}" name="diets[{{ $diet->id }}]" required>
                                        <option label="Select Rate">
                                        </option>
                                        @foreach ($rates as $rate)
                                            <option value="{{$rate->id}}" {{$diet->pivot->rate_id == $rate->id ? 'selected' : ''}}>
                                                {{$rate->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            @endforeach

                            @foreach($diets as $diet)
                                @continue($current_diets->contains($diet->id))
                                <tr>
                                    <td>
                                        <input  data-id="{{ $diet->id }}" type="checkbox"  class="diet-enable mr-1">
                                    </td>
                                    <td>{{ $diet->name }}</td>
                                    <td>
                                        <select class="diet_rate  form-control select2-no-search ml-4" data-id="{{ $diet->id }}" name="diets[{{ $diet->id }}]" disabled required>
											<option label="Select Rate">
											</option>
											@foreach ($rates as $rate)
                                                <option value="{{$rate->id}}">
                                                    {{$rate->name}}
                                                </option>
                                            @endforeach
										</select>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="col" style="height: 50vh; overflow:scroll">
                        {{-- toxin --}}
                        <h3>Toxin Ratings</h3>
                        <table>
                            @foreach ($food->toxins as $toxin)
                            <tr>
                                <td>
                                    <input  data-id="{{ $toxin->id }}" type="checkbox" class="toxin-enable mr-1" checked/>
                                </td>
                                <td>{{ $toxin->name }}</td>
                                <td>
                                    <select class="toxin_rate  form-control select2-no-search ml-4" data-id="{{ $toxin->id }}" name="toxins[{{ $toxin->id }}]" required>
                                        <option label="Select Rate">
                                        </option>
                                        @foreach ($rates as $rate)
                                            <option value="{{$rate->id}}" {{$toxin->pivot->rate_id == $rate->id ? 'selected' : ''}}>
                                                {{$rate->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            @endforeach

                            @foreach($toxins as $toxin)
                                @continue($current_toxins->contains($toxin->id))
                                <tr>
                                    <td>
                                        <input  data-id="{{ $toxin->id }}" type="checkbox" class="toxin-enable mr-1"/>
                                    </td>
                                    <td>{{ $toxin->name }}</td>
                                    <td>
                                        <select class="toxin_rate  form-control select2-no-search ml-4" data-id="{{ $toxin->id }}" name="toxins[{{ $toxin->id }}]" disabled required>
											<option label="Select Rate">
											</option>
											@foreach ($rates as $rate)
                                                <option value="{{$rate->id}}">
                                                    {{$rate->name}}
                                                </option>
                                            @endforeach
										</select>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div> {{--end of card body--}}
                <div class="card-footer">
                    <button class="btn btn-danger">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')

<!-- Internal Rating js-->
<script src="{{URL::asset('assets/plugins/rating/jquery.rating-stars.js')}}"></script>
<script src="{{URL::asset('assets/plugins/rating/jquery.barrating.js')}}"></script>
<script src="{{URL::asset('assets/plugins/rating/ratings.js')}}"></script>

<script>
    $('document').ready(function () {
        $('.diet-enable').on('click', function () {
            let id = $(this).attr('data-id')
            let enabled = $(this).is(":checked")
            $('.diet_rate[data-id="' + id + '"]').attr('disabled', !enabled)
            $('.diet_rate[data-id="' + id + '"]').val(null)
        })
    });
</script>

<script>
    $('document').ready(function () {
        $('.toxin-enable').on('click', function () {
            let id = $(this).attr('data-id')
            let enabled = $(this).is(":checked")
            $('.toxin_rate[data-id="' + id + '"]').attr('disabled', !enabled)
            $('.toxin_rate[data-id="' + id + '"]').val(null)
        })
    });

    $('form').submit(function (e) { 
        let formData = $(this).serializeArray()
        console.log(formData)
        if(!formData.find((element) => element['name'].search('diets') != -1))
        {
            e.preventDefault();
            notif({
                msg: "Woops, Looks like you forgot to select Diet ratings!!",
                type: "error"
            })
        }
        else if(!formData.find((element) => element['name'].search('toxins') != -1))
        {

            e.preventDefault();
            notif({
                msg: "Woops, Looks like you forgot to select Toxin ratings!!",
                type: "error"
            })
        }
    });
</script>

@endsection