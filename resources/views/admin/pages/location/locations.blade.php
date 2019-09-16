@extends('admin.layout.app')
@section('title', 'Admin|Locaions')
@section('content')
<section class="wrapper">
   <!--overview start-->
   <div class="row">
      <div class="col-lg-12">
         <h3 class="page-header"><i class="fa fa-laptop"></i>Locations</h3>
         <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="{{url('/index')}}">Home</a></li>
            <li><i class="fa fa-laptop"></i>Locations</li>
         </ol>
      </div>
   </div>
   <div class="row">
      <div class="col-lg-12">
         <section class="panel">
            <header class="panel-heading">
               Locations list <a href= "{{url('admin/locations/add-location')}}" class = "btn btn-primary pull-right"> <span class="icon_plus_alt2"></span> Add Location</a>
            </header>
            @include('admin.message')
            <div class = "row searchFilter">
               <div class = "col-md-4"></div><div class = "col-md-4"></div>
                  <div class = "col-md-4">
             <input type = "text" name = "search" data-table = "locations" data-url = "admin/locations/edit-location" class = "form-control" placeholder = "Search">
             </div>
            </div>
            <table id="example" class="table table-striped table-advance table-hover" style="width:100%">
               <thead>
                  <tr>
                     <th data-column = "id"><i>#</i> Sr No.</th>
                     <th data-column = "name"><i class="icon_profile"></i> Name</th>
                     <th data-column = "slug"><i class="icon_link_alt"></i> Slug</th>
                     <th data-column = "status"><i class="icon_mail_alt"></i> Status</th>
                     <th><i class="icon_cogs"></i> Action</th>
                  </tr>
               </thead>
               <tbody id = "result">
                  @forelse($locations as $location)
                  <tr>
                     <td>{{$loop->iteration}}</td>
                     <td>{{$location->name}}</td>
                     <td>{{$location->slug }}</td>
                     <td>
                        <a class=" tooltips updatestatus" href="{{url('admin/status-update/locations/'.$location->id)}}" title="Change Status" data-placement="bottom" data-toggle="tooltip">
                           @if($location->status == 1)
                           <div class = "btn-group btn btn-success"><i class="icon_check_alt2"></i></div>
                           @else 
                           <div class = "btn-group btn btn-danger"><i class="icon_close_alt2"></i></div>
                           @endif
                        </a>
                     </td>
                     <td> 
                        <a class="btn btn-primary tooltips " href="{{url(Request::path().'/edit-location/'.$location->id)}}" title="Modify detail" data-placement="bottom" data-toggle="tooltip "><i class="icon_pencil_alt"></i></a>
                        <a class="btn btn-danger tooltips " href="javaScript:void(0)" title="Delete" data-placement="bottom" data-toggle="tooltip " data-target="#exampleModal" onclick="return confirm('Are you sure?')"><i class="icon_trash"></i></a>
                     </td>
                     </tr>
                  @empty
                  <tr>
                     <td colspan = "4">No Location Found</td>
                  </tr>
                  @endforelse
               </tbody>
            </table>
            <div class="clearfix"></div>
            <ul class="pagination pull-right">
               <?php echo $locations->render(); ?>
            </ul>
      </div>
      </section>
   </div>
   </div>
</section>
@endsection