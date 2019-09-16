@extends('admin.layout.app')
@section('title', 'Admin|Edit-Template')
@section('content')
<section class="wrapper">
   <!--overview start-->
   <div class="row">
      <div class="col-lg-12">
         <h3 class="page-header"><i class="fa fa-laptop"></i>Template</h3>
         <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="{{url('/index')}}">Home</a></li>
            <li><i class="fa fa-laptop"></i>Template</li>
         </ol>
      </div>
   </div>      
      <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
               Edit Template 
              </header>
              <div class="panel-body">
                <div class="form">
                  <form class="form-validate form-horizontal" id="feedback_form" method="post" action="">
                  {{csrf_field()}}
                    <div class="form-group ">
                      <label for="cname" class="control-label col-lg-2">Product/Category<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <select name = "product_category" class = "form-control">
                          <option value = "">Choose Product Or Category</option>
                            @forelse($procat as $row)
                              <option value = "{{$row->id}}" {{$template->product_cat_id == $row->id ? 'selected':''}}>{{ parentcatname($row->parent_id) != '' ? parentcatname($row->parent_id)->name.'->' : ''}} {{ $row->name}} {{$row->type == 1 ? "(Product)" : "(Category)"}}</option>
                            @empty
                              <option value = "">No Data Found</option>
                            @endforelse
                        </select>
                        <span class = "text-danger">{{$errors->first('product_category')}}</span>
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="agree" class="control-label col-lg-2 col-sm-3">Version <span class="required">*</span></label>
                      <div class="col-lg-10 col-sm-9">
                        <input class="form-control" id="version" name="version"  type="text" value = "{{$template->version}}"/>
                        <span class = "text-danger">{{$errors->first('version')}}</span>
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="cname" class="control-label col-lg-2">Heading<span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control" id="heading" name="heading" minlength="3" type="text" value = "{{$template->heading}}"/>
                        <span class = "text-danger">{{$errors->first('heading')}}</span>
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="cname" class="control-label col-lg-2">Subheading</label>
                      <div class="col-lg-10">
                        <input class="form-control" id="subheading" name="subheading" minlength="3" type="text" value = "{{$template->subheading}}"/>
                        <span class = "text-danger">{{$errors->first('subheading')}}</span>
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="cname" class="control-label col-lg-2">Title</label>
                      <div class="col-lg-10">
                        <input class="form-control" id="title_area" name="title_area" minlength="3" type="text" value = "{{$template->title_area}}"/>
                        <span class = "text-danger">{{$errors->first('title_area')}}</span>
                      </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Description</label>
                        <div class="col-sm-10">
                           <textarea class="form-control ckeditor" name="description_area" rows="6">{{$template->description_area}}</textarea>
                           <span class = "text-danger">{{$errors->first('description_area')}}</span>
                        </div>
                     </div>
                     <div class="form-group ">
                      <label for="cname" class="control-label col-lg-2">Seo Title</label>
                      <div class="col-lg-10">
                        <input class="form-control" id="seo_title" name="seo_title" minlength="3" type="text" value = "{{$template->seo_title}}"/>
                        <span class = "text-danger">{{$errors->first('seo_title')}}</span>
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="cname" class="control-label col-lg-2">Seo Meta keywords</label>
                      <div class="col-lg-10">
                        <textarea class="form-control" id="seo_meta_keyword" name="seo_meta_keyword" minlength="3" />{{$template->seo_meta_keyword}}</textarea>
                        <span class = "text-danger">{{$errors->first('seo_meta_keyword')}}</span>
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="cname" class="control-label col-lg-2">Seo Meta Description</label>
                      <div class="col-lg-10">
                        <textarea class="form-control" id="seo_meta_description" name="seo_meta_description"/>{{$template->seo_meta_description}}</textarea>
                        <span class = "text-danger">{{$errors->first('seo_meta_description')}}</span>
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="ccomment" class="control-label col-lg-2">Status</label>
                      <div class="col-lg-10">
                      <input type="checkbox" name = "status" checked data-toggle="toggle" data-on="Enabled" data-off="Disabled" value = "1">
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="agree" class="control-label col-lg-2 col-sm-3">make a default <span class="required">*</span></label>
                      <div class="col-lg-10 col-sm-9">
                        <input type="checkbox" style="width: 20px" class="checkbox form-control" id="agree" name="is_default" value = "1" {{$template->is_default == 0 ? '' : 'checked'}}/>
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