@extends('layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">

    <!-- Internal Spectrum-colorpicker css -->
    <link href="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.css') }}" rel="stylesheet">

    <!-- Internal Select2 css -->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('title')
Food database - filters
@stop
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">Food </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Filters</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')

 {{--  errors --}}
 @if ($errors->any())
 <div class="alert alert-danger">
     <ul>
         @foreach ($errors->all() as $error)
             <li>{{ $error }}</li>
         @endforeach
     </ul>
 </div>
@endif

{{-- success message --}}

@if (session()->has('success'))
<script>
     window.onload = function() {
        notif({
            msg: "{{session()->get('success')}}",
            type: "success"
        })
        }
</script>
@endif


<!-- row -->
<div class="row">

    <div class="col-xl-12">
        <div class="card mg-b-20">


            <div class="card-header pb-0">

                <form action="{{route('filter')}}" method="POST" autocomplete="off">
                    @csrf
                    <div class="row mb-3">
                        {{-- Diet rating --}}
                        <div class="col-lg-4 mg-b-20 mg-lg-b-0">
                            <p class="mg-b-10">Diet Rating <span class="text-danger"> *</span></p>
                            <select class="form-control select2" multiple="multiple" id="diet_ratings" name="diet_ratings[]" required>
                                @foreach ($rates as $rate)
                                <option value="{{$rate->id}}">
                                    {{$rate->name}}
                                </option>    
                                @endforeach
                            </select>
                        </div>
                        {{-- diets --}}
                        <div class="col-lg-4 mg-b-20 mg-lg-b-0">
                            <p class="mg-b-10">Individual Diet <span class="text-danger"> *</span></p>
                            <select class="form-control select2" id="diets" multiple="multiple" name="diets[]" required>
                                @foreach ($diets as $diet)
                                <option value="{{$diet->id}}">
                                    {{$diet->name}}
                                </option>    
                                @endforeach
                            </select>
                        </div>         
                    </div>
                     {{-- toxin rating --}}
                     <div class="row">
                        <div class="col-lg-4 mg-b-20 mg-lg-b-0">
                            <p class="mg-b-10">Toxin Rating <span class="text-danger"> *</span></p>
                            <select class="form-control select2" multiple="multiple" id="toxin_ratings" name="toxin_ratings[]" required>
                                @foreach ($rates as $rate)
                                <option value="{{$rate->id}}">
                                    {{$rate->name}}
                                </option>    
                                @endforeach
                            </select>
                        </div>
                        {{-- toxins --}}
                        <div class="col-lg-4 mg-b-20 mg-lg-b-0">
                            <p class="mg-b-10">Individual Toxin <span class="text-danger"> *</span></p>
                            <select class="form-control select2" multiple="multiple" id="toxins" name="toxins[]" required>
                                @foreach ($toxins as $toxin)
                                <option value="{{$toxin->id}}" >
                                    {{$toxin->name}}
                                </option>    
                                @endforeach
                            </select>
                        </div>         
                    </div>

                    <div class="row">
                        <div class="col-sm-1 col-md-1 mt-3 ml-1">
                            <button type='submit' class="btn btn-danger btn-block">Search</button>
                        </div>
                    </div>
                </form>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-lg-nowrap">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">Food name</th>
                                    <th class="border-bottom-0 text-center">Rating</th>
                            <tbody>
                                @foreach ($foods as $food)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$food->name}}</td>
                                    @php
                                        $min = $food->min ?? min([$food->toxins->pluck('pivot')->pluck('rate_id')->min(),
                                         $food->diets->pluck('pivot')->pluck('rate_id')->min()])
                                    @endphp

                                    <td class="text-center">
                                        @if ($min == 4)
                                            <span class="badge badge-pill badge-success p-1">Safe</span>
                                            @elseif ($min == 3)
                                            <span class="badge badge-pill badge-info p-1">Uncertain</span>
                                            @elseif ($min == 2)
                                            <span class="badge badge-pill badge-warning p-1">Moderate</span>
                                            @else
                                            <span class="badge badge-pill badge-danger p-1">Avoid</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
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
<!-- Internal Data tables -->
<script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
<!--Internal  Datatable js -->
<script src="{{ URL::asset('assets/js/table-data.js') }}"></script>

<!--Internal  Datepicker js -->
<script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
<!--Internal  jquery.maskedinput js -->
<script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
<!--Internal  spectrum-colorpicker js -->
<script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
<!-- Internal Select2.min js -->
<script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
<!--Internal Ion.rangeSlider.min js -->
<script src="{{ URL::asset('assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>
<!--Internal  jquery-simple-datetimepicker js -->
<script src="{{ URL::asset('assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js') }}"></script>
<!-- Ionicons js -->
<script src="{{ URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js') }}"></script>
<!--Internal  pickerjs js -->
<script src="{{ URL::asset('assets/plugins/pickerjs/picker.min.js') }}"></script>
<!-- Internal form-elements js -->
<script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>
<script>
    var date = $('.fc-datepicker').datepicker({
        dateFormat: 'yy-mm-dd'
    }).val();
</script>

@isset($old)
{{-- selecting old diets --}}
@foreach ($old->diets as $diet)
    <script>
        $('#diets option[value="{{$diet}}"]').prop('selected', true);
    </script>
@endforeach
{{-- selecting old diet ratings --}}
@foreach ($old->diet_ratings as $rate)
    <script>
        $('#diet_ratings option[value="{{$rate}}"]').prop('selected', true);
    </script>
@endforeach
{{-- selecting old toxins --}}
@foreach ($old->toxins as $toxin)
    <script>
        $('#toxins option[value="{{$toxin}}"]').prop('selected', true);
    </script>
@endforeach
{{-- selecting old toxin ratings --}}
@foreach ($old->toxin_ratings as $rate)
    <script>
        $('#toxin_ratings option[value="{{$rate}}"]').prop('selected', true);
    </script>
@endforeach
@endisset

@endsection