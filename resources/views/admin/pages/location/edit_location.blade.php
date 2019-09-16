@extends('admin.layout.app')
@section('title', 'Admin|dashboad')
@section('content')
<section class="wrapper">
   <!--overview start-->
   <div class="row">
      <div class="col-lg-12">
         <h3 class="page-header"><i class="fa fa-laptop"></i>Dashboard</h3>
         <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="{{url('/index')}}">Home</a></li>
            <li><i class="fa fa-laptop"></i>Location</li>
         </ol>
      </div>
   </div>      
      <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
                Form validations
              </header>
              <div class="panel-body">
                <div class="form">
                  <form class="form-validate form-horizontal" id="feedback_form" method="post" action="{{url(Request::path())}}">
                  {{csrf_field()}}
                 
                    <div class="form-group ">
                      <label for="cname" class="control-label col-lg-2">name<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control" id="cname" name="name" minlength="3" type="text" onkeyup = "convertToSlug()" value = "{{$location->name}}" required />
                        <span class = "text-danger">{{$errors->first('name')}}</span>
                      </div>
                      
                    </div>
                    <div class="form-group ">
                      <label for="cname" class="control-label col-lg-2">Another Name<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control" id="aname" name="another_name" minlength="3" type="text"  value = "{{$location->another_name}}"/>
                        <span class = "text-danger">{{$errors->first('another_name')}}</span>
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="cemail" class="control-label col-lg-2">Slug</label>
                      <div class="col-lg-10">
                        <input class="form-control " id="slug" type="text" name="slug"  value = "{{$location->slug}}"/>
                        <span class = "text-danger">{{$errors->first('slug')}}</span>
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="ccomment" class="control-label col-lg-2">Status</label>
                      <div class="col-lg-10">
                      <input type="checkbox" name = "status"  data-toggle="toggle" data-on="Enabled" data-off="Disabled" value = "{{$location->status}}" {{$location->status==1 ? 'checked' : ''}}>
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="agree" class="control-label col-lg-2 col-sm-3">make a default</label>
                      <div class="col-lg-10 col-sm-9">
                        <input type="checkbox" style="width: 20px" class="checkbox form-control" id="agree" name="is_default" value = "1" {{$location->is_default == 0 ? '' : 'checked'}}/>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-lg-offset-2 col-lg-10">
                        <button class="btn btn-primary" type="submit">Save</button>
                        <button class="btn btn-default" type="button">Cancel</button>
                      </div>
                    </div>
                  </form>
                </div>

              </div>
            </section>
          </div>
        </div>
        </section>
@endsection