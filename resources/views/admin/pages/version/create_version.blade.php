@extends('admin.layout.app')
@section('title', 'Admin|create Version')
@section('content')
<section class="wrapper">
   <!--overview start-->
   <div class="row">
      <div class="col-lg-12">
         <h3 class="page-header"><i class="fa fa-laptop"></i>Mapping With Version </h3>
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
               Add Version-City
              </header>
              <div class="panel-body">
                <div class="form">
                  <form class="form-validate form-horizontal" id="feedback_form" method="post" action="">
                  {{csrf_field()}}
                    <div class="form-group ">
                      <label for="cname" class="control-label col-lg-2">name<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <select class = "form-control" name = "version">
                          <option value = "">Choose version</option>
                          @forelse($version as $data)
                          <option value = "{{$data->id}}">{{$data->version}}</option>
                          @empty
                          <option>No Data Found</option>
                          @endforelse
                        </select>
                        <span class = "text-danger">{{$errors->first('version')}}</span>
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="cname" class="control-label col-lg-2">City<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <select class = "form-control" name = "city[]" multiple id="multiselect">
                          @forelse($locations as $location)
                          <option value = "{{$location->id}}">{{$location->name}}</option>
                          @empty
                          <option value = "">No Data Found</option>
                          @endforelse
                        </select>
                        <span class = "text-danger">{{$errors->first('city')}}</span>
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="ccomment" class="control-label col-lg-2">Status</label>
                      <div class="col-lg-10">
                      <input type="checkbox" name = "status" checked data-toggle="toggle" data-on="Enabled" data-off="Disabled" value = "1">
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