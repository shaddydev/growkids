@extends('admin.layout.app')
@section('title', 'Admin|Profile')
@section('content')
<section class="wrapper">
   <div class="row">
      <div class="col-lg-12">
         <h3 class="page-header"><i class="fa fa-user-md"></i> Profile</h3>
         <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="index.html">Home</a></li>
            <li><i class="icon_documents_alt"></i>Pages</li>
            <li><i class="fa fa-user-md"></i>Profile</li>
         </ol>
      </div>
   </div>
   <div class="row">
      <!-- profile-widget -->
      <div class="col-lg-12">
         <div class="profile-widget profile-widget-info">
            <div class="panel-body">
               <div class="col-lg-2 col-sm-2">
                  <h4>Jenifer Smith</h4>
                  <div class="follow-ava">
                     <img src="img/profile-widget-avatar.jpg" alt="">
                  </div>
                  <h6>Administrator</h6>
               </div>
               <div class="col-lg-4 col-sm-4 follow-info">
                  <p>Hello I’m Jenifer Smith, a leading expert in interactive and creative design.</p>
                  <p>@jenifersmith</p>
                  <p><i class="fa fa-twitter">jenifertweet</i></p>
                  <h6>
                     <span><i class="icon_clock_alt"></i>11:05 AM</span>
                     <span><i class="icon_calendar"></i>25.10.13</span>
                     <span><i class="icon_pin_alt"></i>NY</span>
                  </h6>
               </div>
               <div class="col-lg-2 col-sm-6 follow-info weather-category">
                  <ul>
                     <li class="active">
                        <i class="fa fa-comments fa-2x"> </i><br> Contrary to popular belief, Lorem Ipsum is not simply
                     </li>
                  </ul>
               </div>
               <div class="col-lg-2 col-sm-6 follow-info weather-category">
                  <ul>
                     <li class="active">
                        <i class="fa fa-bell fa-2x"> </i><br> Contrary to popular belief, Lorem Ipsum is not simply
                     </li>
                  </ul>
               </div>
               <div class="col-lg-2 col-sm-6 follow-info weather-category">
                  <ul>
                     <li class="active">
                        <i class="fa fa-tachometer fa-2x"> </i><br> Contrary to popular belief, Lorem Ipsum is not simply
                     </li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- page start-->
   <div class="row">
      <div class="col-lg-12">
         <section class="panel">
            <header class="panel-heading tab-bg-info">
               <ul class="nav nav-tabs">
                  <li class="active">
                     <a data-toggle="tab" href="#recent-activity">
                     <i class="icon-home"></i>
                      Site Setting
                     </a>
                  </li>
                  <li>
                     <a data-toggle="tab" href="#profile">
                     <i class="icon-user"></i>
                     Profile
                     </a>
                  </li>
                  <li class="">
                     <a data-toggle="tab" href="#edit-profile">
                     <i class="icon-envelope"></i>
                     Edit Profile
                     </a>
                  </li>
               </ul>
            </header>
            <div class="panel-body">
               <div class="tab-content">
                  <div id="recent-activity" class="tab-pane ">
                     <div class="profile-activity">
                        <div class="act-time">
                           <div class="activity-body act-in">
                              <span class="arrow"></span>
                              <div class="text">
                                 <a href="#" class="activity-img"><img class="avatar" src="img/chat-avatar.jpg" alt=""></a>
                                 <p class="attribution"><a href="#">Jonatanh Doe</a> at 4:25pm, 30th Octmber 2014</p>
                                 <p>It is a long established fact that a reader will be distracted layout</p>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- profile -->
                  <div id="profile" class="tab-pane">
                     <section class="panel">
                        <div class="bio-graph-heading">
                           Hello I’m Jenifer Smith, a leading expert in interactive and creative design specializing in the mobile medium. My graduation from Massey University with a Bachelor of Design majoring in visual communication.
                        </div>
                        <div class="panel-body bio-graph-info">
                           <h1>Bio Graph</h1>
                           <div class="row">
                              <div class="bio-row">
                                 <p><span>Name </span>: {{$detail->name}} </p>
                              </div>
                              
                              <div class="bio-row">
                                 <p><span>Email </span>:{{$detail->email}}</p>
                              </div>
                              <div class="bio-row">
                                 <p><span>Mobile </span>: (+6283) 456 789</p>
                              </div>
                              <div class="bio-row">
                                 <p><span>Phone </span>: (+021) 956 789123</p>
                              </div>
                           </div>
                        </div>
                     </section>
                     <section>
                        <div class="row">
                        </div>
                     </section>
                  </div>
                  <!-- edit-profile -->
                  <div id="edit-profile" class="tab-pane">
                     <section class="panel">
                        <div class="panel-body bio-graph-info">
                           <h1> Profile Info</h1>
                           <span id = "msg"></span>
                           <form class="form-horizontal" method = "post" role="form" enctype = "multipart/form-data" id = "profileupdate">
                             {{csrf_field()}}
                             <div class="alert-danger print-error-msg form-group" style = "display:none">
                                <ul></ul>
                              </div>
                              <div class="form-group">
                                 <label class="col-lg-2 control-label">First Name</label>
                                 <div class="col-lg-6">
                                    <input type="text" class="form-control" id="name" placeholder=" " name = "name" value = "{{$detail->name}}">
                                    
                                  </div>
                              </div>

                              <div class="form-group">
                                 <label class="col-lg-2 control-label">Email</label>
                                 <div class="col-lg-6">
                                    <input type="text" class="form-control" id="email" placeholder=" " name = "email" value = "{{$detail->email}}">
                                    
                                 </div>
                              </div>
                              
                              <div class="form-group">
                                 <label class="col-lg-2 control-label">Password</label>
                                 <div class="col-lg-6">
                                    <input type="text" class="form-control" id="password" placeholder=" " name = "password">
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label class="col-lg-2 control-label">Confirm Password</label>
                                 <div class="col-lg-6">
                                    <input type="text" class="form-control" id="confirm-password" placeholder=" " name = "password_confirmation">
                                 </div>
                              </div>
                             
                              <div class="form-group">
                                 <label class="col-lg-2 control-label">Profile Image</label>
                                 <div class="col-lg-6">
                                    <input type="file" class="form-control" id="profile_img" name = "profile_img">
                                    <br>
                                    <img id="previewHolder" alt="Uploaded Image Preview Holder" width="150px" height="150px" style = "display:none"/>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="col-lg-offset-2 col-lg-10">
                                    <button type="button" id = "sendProfileData" class="btn btn-primary">Save</button>
                                    <button type="button" class="btn btn-danger">Cancel</button>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </section>
                  </div>
               </div>
            </div>
         </section>
      </div>
   </div>
   <!-- page end-->
</section>
@endsection