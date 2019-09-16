@extends('admin.layout.app')
@section('title', 'Admin|Tempates')
@section('content')
<section class="wrapper">
   <!--overview start-->
   <div class="row">
      <div class="col-lg-12">
         <h3 class="page-header"><i class="fa fa-laptop"></i>Templates</h3>
         <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="{{url('/index')}}">Home</a></li>
            <li><i class="fa fa-laptop"></i>Templates</li>
         </ol>
      </div>
   </div>
   <div class="row">
      <div class="col-lg-12">
         <section class="panel">
            <header class="panel-heading">
            Templates List <a href= "{{url('admin/template/add-template')}}" class = "btn btn-primary pull-right"> <span class="icon_plus_alt2"></span> Create Tempalate</a> 
            </header>
            @include('admin.message')
            <div class = "row searchFilter">
            <div class = "col-md-4"></div><div class = "col-md-4"></div>
               <div class = "col-md-4">
                  <input type = "text" placeholder = "Seach" name = "search" data-table = "template" base-url = "{{ url()->current()}}" edit-url = "{{ url()->current().'/edit-template'}}" delete-url = "{{ url()->current().'/delete-template'}}" class = "form-control">
               </div>
              
            </div>
             <table id="example" class="table table-striped table-advance table-hover" style="width:100%">
               <thead>
                  <tr>
                     <th data-column= "template.id"><i >#</i> Sr No.</th>
                     <th data-column = "template.title_area"><i class="icon_profile"></i> Title</th>
                     <th data-column = "template.version"><i class="icon_tags"></i> Version</th>
                     <th data-column = "template.heading"><i class="icon_calendar"></i> heading</th>
                     <th data-column = "products.name" data-join = "products,product_cat_id"><i class="icon_calendar"></i> Product</th>
                     <th data-column = "template.status"><i class="icon_mail_alt"></i> Status</th>
                     <th><i class="icon_cogs"></i>Action</th>
                  </tr>
               </thead>
               <tbody id = "result">
                  @forelse($templates as $row)
                  <tr>
                     <td>{{$loop->iteration}}</td>
                     <td>{{$row->title_area}}</td>
                     <td>{{$row->version}}</td>
                     <td>{{$row->heading}}</td>
                     <td>{{$row['products']['name']}}</td>
                     <td>
                        <a class=" tooltips updatestatus" href="{{url('admin/status-update/template/'.$row->id)}}" title="Change Status" data-placement="bottom" data-toggle="tooltip">
                           @if($row->status == 1)
                           <div class = "btn-group btn btn-success"><i class="icon_check_alt2"></i></div>
                           @else 
                           <div class = "btn-group btn btn-danger"><i class="icon_close_alt2"></i></div>
                           @endif
                        </a>
                     </td>
                     <td> 
                        <a class="btn btn-primary tooltips " href="{{url(Request::path().'/edit-template/'.$row->id)}}" title="Modify detail" data-placement="bottom" data-toggle="tooltip "><i class="icon_pencil_alt"></i></a>
                        <a class="btn btn-danger tooltips " href="{{url(Request::path().'/delete-template/'.$row->id)}}" title="Delete" data-placement="bottom" data-toggle="tooltip" onclick="return confirm('Are you sure?')"><i class="icon_trash"></i></a>
                     </td>
                  </tr>
                  @empty
                  <tr>
                     <td colspan = "4">No Product Found</td>
                  </tr>
                  @endforelse
                  <tr><td colspan="6">
                     <ul class="pagination pull-right">
               <?php echo $templates->render(); ?>
            </ul>
         </td></tr>
               </tbody>

            </table>
            <div class="clearfix"></div>
           
      </div>
      </section>
   </div>
   </div>
</section>
@endsection