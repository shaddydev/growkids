@extends('admin.layout.app')
@section('title', 'Admin|Products')
@section('content')
<section class="wrapper">
   <!--overview start-->
   <div class="row">
      <div class="col-lg-12">
         <h3 class="page-header"><i class="fa fa-laptop"></i>Products</h3>
         <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="{{url('/index')}}">Home</a></li>
            <li><i class="fa fa-laptop"></i>Products</li>
         </ol>
      </div>
   </div>
   <div class="row">
      <div class="col-lg-12">
         <section class="panel">
            <header class="panel-heading">
              Products List <a href= "{{url('admin/products/add-product')}}" class = "btn btn-primary pull-right"> <span class="icon_plus_alt2"></span> Add Product</a> 
            </header>
            @include('admin.message')
            <div class = "row searchFilter">
            <div class = "col-md-4"></div><div class = "col-md-4"></div>
               <div class = "col-md-4">
                  <input type = "text" placeholder = "Seach" name = "search" data-table = "products" data-table = "template" base-url = "{{ url()->current()}}" edit-url = "{{ url()->current().'/edit-product'}}" delete-url = "{{ url()->current().'/delete-product'}}" class = "form-control">
               </div>
            </div>
             <table id="example" class="table table-striped table-advance table-hover" style="width:100%">
               <thead>
                  <tr>
                     <th data-column= "id"><i >#</i> Sr No.</th>
                     <th data-column = "name"><i class="icon_profile"></i> Name</th>
                     <th data-column = "sku"><i class="icon_calendar"></i> SKU</th>
                     <th data-column = "type"><i class="icon_profile"></i> type</th>
                     <th data-column = "slug"><i class="icon_link_alt"></i> Slug</th>
                     <th data-column = "status"><i class="icon_mail_alt"></i> Status</th>
                     <th><i class="icon_cogs"></i>Action</th>
                  </tr>
               </thead>
               <tbody id = "result">
                  @forelse($products as $product)
                  <tr>
                     <td>{{$loop->iteration}}</td>
                     <td>{{$product->name}}</td>
                     <td>{{$product->sku}}</td>
                     <td>{{$product->type == 0 ? 'Category' : 'Product'}}</td>
                     <td>{{$product->slug }}</td>
                     <td>
                        <a class=" tooltips updatestatus" href="{{url('admin/status-update/products/'.$product->id)}}" title="Change Status" data-placement="bottom" data-toggle="tooltip">
                           @if($product->status == 1)
                           <div class = "btn-group btn btn-success"><i class="icon_check_alt2"></i></div>
                           @else 
                           <div class = "btn-group btn btn-danger"><i class="icon_close_alt2"></i></div>
                           @endif
                        </a>
                     </td>
                     <td> 
                        <a class="btn btn-primary tooltips " href="{{url(Request::path().'/edit-product/'.$product->id)}}" title="Modify detail" data-placement="bottom" data-toggle="tooltip "><i class="icon_pencil_alt"></i></a>
                        <a class="btn btn-danger tooltips " href="{{url(Request::path().'/delete-product/'.$product->id)}}" title="Delete" data-placement="bottom" data-toggle="tooltip" onclick="return confirm('Are you sure?')"><i class="icon_trash"></i></a>
                     </td>
                  </tr>
                  @empty
                  <tr>
                     <td colspan = "4">No Product Found</td>
                  </tr>
                  @endforelse
                  <tr><td colspan="6">
                     <ul class="pagination pull-right">
               <?php echo $products->render(); ?>
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