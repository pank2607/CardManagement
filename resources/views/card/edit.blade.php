@extends('layouts.app')
@section('page-css')

@endsection

@section('content')
<div class="row page-header">
  <div class="col-lg-6 align-self-center ">    
    <h2>Edit Card</h2>  
      <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/')}}">Home</a></li>         
          <li class="breadcrumb-item active">Edit Card</li>
      </ol>
  </div>
</div>

<section class="main-content">
  <div class="validation_error_box" role="alert"></div>
  @if(Session::has('message'))
    <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">×</span>
        </button>{{ Session::get('message') }}
    </div>
  @endif
  @if (count($errors) > 0)
    <div class="alert bg-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
      @foreach ($errors->all() as $error)
        <strong>Error !</strong> {{ $error }}<br/>
      @endforeach
    </div>
  @endif 
  <form method="post" id="cardForm" class="form-horizontal" action="{{ url('update-card') }}" enctype="multipart/form-data">
  <div class="row">
    <div class="col-sm-12">
      <input type="hidden" name="id" value="{{$card->id}}">
      <input type="hidden" name="slug" value="{{$card->slug}}">
      <div class="card">
        <div class="card-header card-default section-header">
          <div class="row">
            <div class="col-sm-12">
              Edit Card
            </div>
          </div>
        </div>
        <div class="card-body">
        {{ csrf_field() }}
          <div class="row">             
            <div class="col-sm-6">  
              <div class="form-group">
                <label for="name">Person Name:</label>
                <input type="text" class="form-control" id="person_name" name="person_name" placeholder="" value="{{$card->person_name}}" />
              </div>
            </div>
             
            <div class="col-sm-6"> 
              <div class="form-group">
                <label for="name">Designation:</label>
                <input type="text" class="form-control" name="designation" placeholder="" value="{{$card->designation}}" />
              </div>                
            </div>                
             

            <div class="col-sm-6"> 
              <div class="form-group">
                <label for="email">Business Name:</label>
                <input type="text" class="form-control" name="business_name" placeholder="" value="{{$card->business_name}}" />
              </div>
            </div>

            <div class="col-sm-6"> 
              <div class="form-group">                  
                <label for="mobile_number">WhatsApp Number:</label>
                  <input type="text" class="form-control" id="whatsapp_number" maxlength="10" name="whatsapp_number" placeholder="" value="{{$card->whatsapp_number}}"/> 
              </div>
            </div>
             

             <div class="col-sm-6"> 
                <div class="form-group">
                  <label for="email">Short Description:</label>
                  <textarea class="form-control" name="short_description">{{$card->short_description}}</textarea>                  
                </div>
              </div>

             <div class="col-sm-6"> 
                <div class="form-group">
                  <label for="address_line_1">Contacts:</label>
                  <input type="text" class="form-control" id="email" name="email" placeholder="" value="{{$card->email}}" />
                </div>
              </div>

             <div class="col-sm-6">
                <div class="form-group">
                  <label for="address_line_2">Address:</label>                   
                  <textarea class="form-control" id="address" name="address" >{{$card->address}}</textarea> 
                </div>
              </div>

               <div class="col-sm-6">
                 <div class="form-group">
                  @if(!empty($card->photo))   
                   <div class="profile-img">                           
                      <img src="{{ asset('storage/'.$card->photo) }}" height="240" width="240" alt=""/>                            
                  </div>    
                  @endif           
                  <input type="file" name="image" id="images" accept="image/x-png,image/gif,image/jpeg">                           
                </div>
               </div>
            </div> 
         <div class="card-body text-center">
            <button type="submit" class="btn btn-lg btn-primary">Update</button>
          </div>
      </div>     
    </div>
  </div>
</form>
</section>
@endsection