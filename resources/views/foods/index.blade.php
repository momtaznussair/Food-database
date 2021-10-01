@extends('layouts.master')

@section('title')
	Food
@endsection
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Food</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Manage Food</span>
						</div>
					</div>
					<div class="d-flex my-xl-auto right-content">
						
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
								<div class="d-flex justify-content-between">
									{{-- <div class="col-sm-6 col-md-4 col-xl-3">
										<a class="btn btn-outline-primary btn-block"  href="{{route('foods.create')}}">Add New Food Item</a>
									</div>
									<div class="col-sm-6 col-md-4 col-xl-3">
										<form action="{{route('import')}}" method="post" enctype="multipart/form-data">
											@csrf
											<button class="btn btn-sm btn-success mb-1 ml-3" type="submit">Import</button>
											<input class="form-control" type="file" name="file" id="file" required>
										</form>
									</div> --}}
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="example1" class="table key-buttons text-md-nowrap" data-page-length="50">
										<thead>
											<tr class="text-center">
												<th class="border-bottom-0">#</th>
												<th class="border-bottom-0">Name</th>
												<th class="border-bottom-0 w-25">Diets</th>
												<th class="border-bottom-0 w-25">Toxins</th>
												{{-- <th class="border-bottom-0">Operations</th> --}}
											</tr>
										</thead>
										<tbody>
											@foreach ($foods as $food)
											<tr class="text-center">
												<td class="align-middle">{{$loop->iteration}}</td>
												<td class="align-middle">{{$food->name}}</td>
                                                <td class="w-25 align-middle">
                                                    @foreach ($food->diets as $diet)
                                                        @if ($diet->pivot->rate_id == 1)
                                                            <span class="badge badge-pill bg-danger text-light p-1">{{$diet->name}}</span>
                                                        @elseif ($diet->pivot->rate_id == 2)
                                                            <span class="badge badge-pill bg-warning text-light p-1">{{$diet->name}}</span>
                                                        @elseif ($diet->pivot->rate_id == 3)
                                                            <span class="badge badge-pill bg-info text-light p-1">{{$diet->name}}</span>
                                                        @elseif ($diet->pivot->rate_id == 4)
                                                            <span class="badge badge-pill bg-success text-light p-1">{{$diet->name}}</span>
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td class="w-25 align-middle">
                                                    @foreach ($food->toxins as $toxin)
                                                        @if ($toxin->pivot->rate_id == 1)
                                                            <span class="badge badge-pill bg-danger text-light p-1">{{$toxin->name}}</span>
                                                        @elseif ($toxin->pivot->rate_id == 2)
                                                            <span class="badge badge-pill bg-warning text-light p-1">{{$toxin->name}}</span>
                                                        @elseif ($toxin->pivot->rate_id == 3)
                                                            <span class="badge badge-pill bg-info text-light p-1">{{$toxin->name}}</span>
                                                        @elseif ($toxin->pivot->rate_id == 4)
                                                            <span class="badge badge-pill bg-success text-light p-1">{{$toxin->name}}</span>
                                                        @endif
                                                    @endforeach
                                                </td>
												{{-- <td class="align-middle">
													<a class="btn btn-sm btn-info" href="{{route('foods.edit', $food->id)}}" title="Edit">
                                                    <i class="las la-pen"></i></a>

													<a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
													data-id="{{ $food->id }}" data-food_name="{{ $food->name }}"
													data-toggle="modal" href="#modaldemo9" title="Delete"><i
														class="las la-trash"></i></a>
												</td> --}}
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>

				{{-- delete modal --}}
				 <div class="modal" id="modaldemo9">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content modal-content-demo">
							<div class="modal-header">
								<h6 class="modal-title">Delete Food Item</h6><button aria-label="Close" class="close" data-dismiss="modal"
									type="button"><span aria-hidden="true">&times;</span></button>
							</div>
							<form action="" method="post">
								@method('delete')
								@csrf
								<div class="modal-body">
									<p>Are you sure you wanna Delete this Food Item ?</p><br>
									<input class="form-control" name="name" id="del_food_name" type="text" readonly>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
									<button type="submit" class="btn btn-danger">Confirm</button>
								</div>
						</div>
						</form>
					</div>
				</div>
				{{--end of delete modal --}}

				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<!-- Internal Select2 js-->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!-- Internal Modal js-->
<script src="{{URL::asset('assets/js/modal.js')}}"></script>


{{-- modals data --}}
{{-- delete --}}

<script>
    $('#modaldemo9').on('show.bs.modal', function(event) {
        let button = $(event.relatedTarget)
        let id = button.data('id')
        let food_name = button.data('food_name')
        let modal = $(this)
		modal.find('form').attr('action', `foods/${id}`);
        modal.find('.modal-body #del_food_name').val(food_name);
    })
</script>
@endsection