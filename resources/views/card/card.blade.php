@extends('layouts.app')
@section('page-css')
<style type="text/css">   
.emp-profile{
    padding: 1%;  
    margin-bottom: 1%;
    border-radius: 0.5rem;
    background: #fff;
}

.profile-img img{
    width: 70%;
    height: 100%;
}

.profile-head h5{
    color: #333;
}
.profile-head h6{
    color: #0062cc;
}
.profile-edit-btn{
    border: none;
    border-radius: 1.5rem;
    width: 70%;
    padding: 2%;
    font-weight: 600;
    color: #6c757d;
    cursor: pointer;
}
.proile-rating{
    font-size: 12px;
    color: #818182;
    margin-top: 5%;
}
.proile-rating span{
    color: #495057;
    font-size: 15px;
    font-weight: 600;
}
.profile-head .nav-tabs{
    margin-bottom:5%;
}
.profile-head .nav-tabs .nav-link{
    font-weight:600;
    border: none;
}
.profile-head .nav-tabs .nav-link.active{
    border: none;
    border-bottom:2px solid #0062cc;
}
.profile-work{
    padding: 14%;
    margin-top: -15%;
}
.profile-work p{
    font-size: 12px;
    color: #818182;
    font-weight: 600;
    margin-top: 10%;
}
.profile-work a{
    text-decoration: none;
    color: #495057;
    font-weight: 600;
    font-size: 14px;
}
.profile-work ul{
    list-style: none;
}
.profile-tab label{
    font-weight: 600;
}
.profile-tab p{
    font-weight: 600;
    color: #0062cc;
}
</style>
@endsection

@section('content')
<div class="row page-header">
  <div class="col-lg-6 align-self-center ">    
    <h2>View Card</h2>  
      <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/')}}">Home</a></li>         
          <li class="breadcrumb-item active">View Card</li>
      </ol>
  </div>
</div>
<section class="main-content">
<div class="emp-profile">
    <form method="post">
        <div class="row">
            <div class="col-md-4">
                <div class="profile-img">                           
                    <img src="{{ asset('storage/'.$card->photo) }}" alt=""/>                            
                </div>
            </div>
            <div class="col-md-8">
                  <div class="row">
                <div class="col-md-10">
                    <div class="profile-head">
                                <h5>
                                    {{$card->person_name}}
                                </h5>
                                <h6>
                                    {{$card->designation}}
                                </h6>                          
                    </div>
                </div>
                <div class="col-md-2">
                    <a class="profile-edit-btn" href="{{ url('/card/edit/'.$card->slug) }}">Edit Profile</a>                    
                </div>
            </div>
            <div class="row">
          
            <div class="col-md-12">
                <div class="tab-content profile-tab" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Business Name</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{$card->business_name}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Description</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{$card->short_description}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Whatsapp Number</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{$card->whatsapp_number}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Contacts</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{$card->email}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Address</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{$card->address}}</p>
                                    </div>
                                </div>
                    </div>                            
                </div>
            </div>
        </div>
            </div>
        </div>               
    </form>           
</div>
</section>
@endsection        