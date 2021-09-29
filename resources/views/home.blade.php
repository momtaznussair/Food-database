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

                <form action="#" method="POST" autocomplete="off">
                    @csrf
                    <div class="row mb-3">
                        {{-- Diet rating --}}
                        <div class="col-lg-4 mg-b-20 mg-lg-b-0">
                            <p class="mg-b-10">Diet Rating</p><select class="form-control select2" multiple="multiple">
                                @foreach ($rates as $rate)
                                <option value="{{$rate->id}}">
                                    {{$rate->name}}
                                </option>    
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="col-lg-4 mg-b-20 mg-lg-b-0">
                            <p class="mg-b-10">Individual Diet</p><select class="form-control select2" multiple="multiple">
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
                            <p class="mg-b-10">Toxin Rating</p>
                            <select class="form-control select2" multiple="multiple">
                                @foreach ($rates as $rate)
                                <option value="{{$rate->id}}">
                                    {{$rate->name}}
                                </option>    
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="col-lg-4 mg-b-20 mg-lg-b-0">
                            <p class="mg-b-10">Individual Toxin</p>
                            <select class="form-control select2" multiple="multiple">
                                @foreach ($toxins as $toxin)
                                <option value="{{$toxin->id}}">
                                    {{$toxin->name}}
                                </option>    
                                @endforeach
                            </select>
                        </div>         
                    </div>

                    {{-- <div class="row">
                        <div class="col-sm-1 col-md-1">
                            <button class="btn btn-primary btn-block">Search</button>
                        </div>
                    </div> --}}
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
                                <tr>
                                    <td>1</td>
                                    <td>Apples</td>
                                    <td class="text-center">
                                        <span class="badge badge-pill badge-success">Safe</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Apricots</td>
                                    <td class="text-center">
                                        <span class="badge badge-pill badge-info">Uncertain</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Artichokes Jerusalem</td>
                                    <td class="text-center"><span class="badge badge-pill badge-warning">Moderate</span></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Barley</td>
                                    <td class="text-center"><span class="badge badge-pill badge-danger">Avoid</span></td>
                                </tr>
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

<script>
    $(document).ready(function() {

        $('select[name="section"]').on('change', function() {
            let SectionId = $(this).val();
            console.log(SectionId);
            if (SectionId) {
                $.ajax({
                    url: "{{ URL::to('section') }}/" + SectionId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        @if (old('section'))
                            $('select[name="product"]').empty();
                            $('select[name="product"]').append('<option value="all" selected>الكل</option>');
                        @endif
                        $.each(data, function(key, value) {
                            $('select[name="product"]').append(
                                '<option value="' +
                                value.id + '">' + value.product_name +
                                '</option>');
                        });
                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });

        // error message for section
        $('form').on('submit', function(){
            section = $('select[name="section"]').val();
            if(!section)
            {
                notif({
                    msg: "<strong>يرجى أختيار القسم</strong>",
                    type: "error"
                })

                return false;
            }
        })
    });
</script>


@endsection