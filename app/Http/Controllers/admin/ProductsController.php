<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\ProductImg;
use DB;
use Image;
class ProductsController extends Controller
{
    //
    /**
     * View all Product and controller 
     * @method index
     * @param null
     */
    public function index()
    {
        $products = Product::with('productimg')->OrderBy('name')->paginate(10);
        return view('admin.pages.product.products',compact('products'));
    }
    
    /**
     * Create Product and category
     * @method create
     * @param null
     */
    public function create(Request $request,$id = null)
    {  
         
        if($id){ $product = Product::with('productimg')->find($id);}
        
        $views = !empty($id) ? 'edit_product' : 'add_product';
        if ($request->isMethod('post')) {
          // echo "<pre>"; print_r($request->all());exit;
            $validatedData = $request->validate([
            'name' => 'required',
            'category' =>Rule::requiredIf($request->type == 1),
            'sku'=>Rule::requiredIf($request->type == 1),
        ]);
        
        $banner_image_file = $request->file('banner_img');
        $bannerimageName ='';
        if(!empty($banner_image_file)){
        $bannerimageName = Str::slug($request->name).'.'.$banner_image_file->getClientOriginalExtension();

        $image_resize = Image::make($banner_image_file->getRealPath());              
        $image_resize->resize(1920,750);
        $image_resize->save(public_path('./uploads/banner/resizebanner/'.$bannerimageName));
        
        //$banner_image_file->move('./uploads/banner/',$bannerimageName);
        }
        
        $data = $request->all();
        $data['slug'] = Str::slug($request->slug == '' ? $request->name:$request->slug);
        $data['status'] =  $request->status != '' ? '1' : '0';
        $data['parent_id'] = $request->category != '' ? $request->category : '0' ;
        $data['banner_img'] = $bannerimageName != "" ? $bannerimageName : $request->banner_img;
        $data['is_feature'] =  $request->is_feature ;

        try{
           
            $result = Product::updateOrCreate(['id' => $id],$data);
            if($result){
 
                $image ='';
              
               // For Image Upload only 
               if($request->hasFile('product_img')){
                
                 if($id>0){
                    $img_name = ProductImg::where('product_id',$id)->where('media_type',0)->get();
                    
                    if($img_name)
                       { 
                         foreach($img_name as $img) {
                            unlink(public_path('./uploads/products/resizepath/'.$img->product_img));
                            unlink(public_path('./uploads/products/'.$img->product_img));
                         }
                        }
                        ProductImg::where('product_id',$id)->where('media_type',0)->delete();
                    } 

                   $i=0; foreach($request->file('product_img') as $image_file)
                    {
                       
                    // Resize Image 
                        $file = $image_file;
                        $imageName = Str::slug($request->name).$result->id.'_'.$i.'.'.$image_file->getClientOriginalExtension();
                    
                        $image_resize = Image::make($file->getRealPath());              
                        $image_resize->resize(300, 300);
                        $image_resize->save(public_path('./uploads/products/resizepath/' .$imageName));
        
                        $file->move('./uploads/products/', $imageName);
                        
                        $files['product_img']= $imageName ;
                        $files['product_id'] = $result->id;
                        $files['status'] =  $request->status != '' ? '1' : '0';
                        $files['media_type'] = '0';
                        $files['is_default_img'] = $request->is_default[$i];
                        //echo $request->is_default[$i];
                        ProductImg::Create($files);
                       
                        //echo "<pre>";print_r($files);
                   $i++; }
                   //exit;
                }
               
                // For insert video Url only
                if(count(array_filter($request->videourl))>0){
                    foreach($request->videourl as $url){
                        $files['product_img']= $url ;
                        $files['product_id'] = $result->id;
                        $files['status'] =  $request->status != '' ? '1' : '0';
                        $files['media_type'] = '1';

                        $img_id = count($img_name) > $i ? $img_name[$i]->id : ''  ;
                        ProductImg::Create($files);
                    }
                }
                
                return redirect('admin/products')->with('success','Product Added successful');
            } 
            else{
                return redirect('admin/products/add-product')->with('error','Something went wrong');
            }
        }catch(\Exception $e){
           
            return redirect('admin/products/add-product')->with('error',$e->getMessage());
                
        }
    }
    $category = Product::orderBY('type')->where('type',0)->get();
    return view('admin.pages.product.'.$views,compact('product','category'));
    }
    /**
     * Delete Product or category
     * @method deleteProduct
     * @param product_id
     */
    public function deleteProduct(Request $request, $id = null)
    {
        try{
          $result =  Product::where('id',$id)->first();
          if($result->type == 1){
            Product::where('id',$id)->delete();
            return redirect('admin/products')->with('success','Product deleted successful');
          }
          else{
            $data = Product::where('parent_id',$id)->get()->toArray();
           
            if(count($data)>0)
            {   
                return redirect('admin/products')->with('error','Category can not be deleted, because It have products');
            }
            else{
               
                Product::where('id',$id)->delete();
                $img_name = ProductImg::where('product_id',$id)->first();
                    if($img_name){
                    unlink(public_path('./uploads/products/resizepath/'.$img_name->product_img));
                    unlink(public_path('./uploads/products/'.$img_name->product_img));
                }
                return redirect('admin/products')->with('success','Product deleted successful');
            }
          }
       

        }catch(\Exception $e){
            
            return back()->with('error',$e->getMessage());
                
        }
    }
}
