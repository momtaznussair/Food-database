@extends('layouts.master')

@section('title')
	Toxins
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
							<h4 class="content-title mb-0 my-auto">Toxins</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Manage Toxins</span>
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
									<div class="col-sm-6 col-md-4 col-xl-3">
										<a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">Add New Toxin</a>
									</div>
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="example1" class="table key-buttons text-md-nowrap" data-page-length="50">
										<thead>
											<tr class="text-center">
												<th class="border-bottom-0">#</th>
												<th class="border-bottom-0">Diet Name</th>
												<th class="border-bottom-0">Operations</th>
											</tr>
										</thead>
										<tbody>
											@foreach ($toxins as $index => $toxin)
											<tr class="text-center">
												<td>{{$index + 1}}</td>
												<td>{{$toxin->name}}</td>
												<td>
													<a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
													data-id="{{ $toxin->id }}" data-toxin_name="{{ $toxin->name }}"
													data-toggle="modal" href="#exampleModal2" title="Edit">
                                                    <i class="las la-pen"></i></a>

													<a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
													data-id="{{ $toxin->id }}" data-toxin_name="{{ $toxin->name }}"
													data-toggle="modal" href="#modaldemo9" title="Delete"><i
														class="las la-trash"></i></a>
												</td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					{{-- add a diet modal --}}
					<div class="modal fade" id="modaldemo8">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content modal-content-demo">
								<div class="modal-header">
									<h6 class="modal-title">Add A Toxin</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
								</div>
								<div class="modal-body">
									<form action="{{ route('toxins.store') }}" method="post" autocomplete="off">
										@csrf
										<div class="form-group">
											<label for="name">Toxin Name</label>
											<input type="text" class="form-control" id="name" name="name" required>
										</div>
										
										<div class="modal-footer">
											<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Cancel</button>
											<button class="btn ripple btn-primary" type="submit">Confirm</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					{{--end of  add a toxin modal --}}


					{{-- edit a toxin modal --}}
					<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
					aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Edit Toxin</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">

								<form action="" method="post" autocomplete="off">
									@method('put')
									@csrf
									<div class="form-group">
										<label for="diet_name" class="col-form-label">Diet Name:</label>
										<input class="form-control" name="name" id="diet_name" type="text">
									</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
								<button type="submit" class="btn btn-primary">Confirm</button>
							</div>
							</form>
						</div>
					</div>
				</div>

				{{-- end of edit a toxin modal --}}


				{{-- delete modal --}}
				 <div class="modal" id="modaldemo9">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content modal-content-demo">
							<div class="modal-header">
								<h6 class="modal-title">Delete Toxin</h6><button aria-label="Close" class="close" data-dismiss="modal"
									type="button"><span aria-hidden="true">&times;</span></button>
							</div>
							<form action="" method="post">
								@method('delete')
								@csrf
								<div class="modal-body">
									<p>Are you sure you wanna Delete this Toxin ?</p><br>
									<input class="form-control" name="name" id="del_toxin_name" type="text" readonly>
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
{{-- edit --}}
<script>
    $('#exampleModal2').on('show.bs.modal', function(event) {
        let button = $(event.relatedTarget)
        let id = button.data('id')
        let toxin_name = button.data('toxin_name')
        let modal = $(this)
		modal.find('form').attr('action', `toxins/${id}`);
        modal.find('.modal-body #diet_name').val(toxin_name);
    })
</script>
{{-- delete --}}

<script>
    $('#modaldemo9').on('show.bs.modal', function(event) {
        let button = $(event.relatedTarget)
        let id = button.data('id')
        let toxin_name = button.data('toxin_name')
        let modal = $(this)
		modal.find('form').attr('action', `toxins/${id}`);
        modal.find('.modal-body #del_toxin_name').val(toxin_name);
    })
</script>
@endsection