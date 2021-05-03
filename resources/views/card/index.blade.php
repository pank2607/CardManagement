@extends('layouts.app')

@section('page-css')
<style>
#datatable{
    width: 100% !important;
}
.margin-r-5{margin-right: 5px;}
</style>
@endsection

@section('content')
<div class="row page-header">
    <div class="col-lg-6 align-self-center ">
      <h2>Card</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/')}}">Home</a></li>         
            <li class="breadcrumb-item active">View Existing Card</li>
        </ol>
    </div>   
    <div class="col-lg-6 align-self-center text-right">
        <a href="{{ url('add-card') }}" class="btn btn-success box-shadow btn-icon btn-rounded"><i class="fa fa-plus"></i>Add Card</a>
    </div>
  
</div>

<section class="main-content">
    @if(Session::has('message'))
        <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>{{ Session::get('message') }}
        </div>
    @endif
  <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-default section-header">
                View Existing Card
            </div>
            <div class="card-body">              
                <table id="datatable" class="table table-striped dt-responsive nowrap">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Name</th>
                            <th>Designation</th>
                            <th>Business Name</th>
                            <th>Whatsapp Number</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</section>

@endsection
@section('Page-Js')
<script type="text/javascript">
$(document).ready(function () {
    var page_length = 10;
    var dt =  $('#datatable').DataTable({
        pageLength: page_length,
        processing: true,
        serverSide: true,    
        ajax: '{{ url('all-card-json') }}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'designation', name: 'designation' },
            { data: 'business_name', name: 'business_name' },
            { data: 'whatsapp_number', name: 'whatsapp_number' },
            { data: 'action', name: 'action', orderable: false, searchable:false}
        ]
    });
});
</script>
@endsection
