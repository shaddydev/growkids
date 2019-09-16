<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Template;
use Illuminate\Validation\Rule;
class TemplatesController extends Controller
{
    //
    /**
     * Fetch all data 
     * @method index
     * @param null
     * 
     */
    public function index()
    {  
        $templates = Template::with('products')->paginate(10);
        //print_r($templates);exit;
        return view('admin.pages.tempate.template',compact('templates'));
    }
    /**
     * Create Template page 
     * @method Create
     * @param id
     */
    public function create(Request $request,$id = null)
    {   
        if($id){ $template = Template::with('products')->find($id);}
        $views = !empty($id) ? 'edit_template' : 'add_template';
        if ($request->isMethod('post')) {
            $validatedData = $request->validate([
                'product_category' => 'required',
                'heading' => 'required',
                'title_area' => 'required',
                'description_area'=> 'required',
                'version' => 'required'
            ]);
            if($id ==''){
                $validatedData = $request->validate([
                   'version' =>['required',Rule::unique('template')->where(function ($query) use($request,$id) {
                        return $query->where('product_cat_id',$request->product_category);
                    })]
                ]);
            }
            $data = $request->all();
            $check_deault = Template::all();
            if(!empty($request->is_default)){
                foreach($check_deault as $default){

                Template::where('id',$default->id)->update(array('is_default'=>'0'));
               
                } 
             }
            $data['product_cat_id']=$request->product_category;
            $template = Template::updateOrCreate(['id'=>$id],$data);
            if($template){
                return redirect('admin/template')->with('success','Template created successful');
            } 
            else{
                return redirect('admin/template/add-template')->with('error','Something went wrong');
            }
        }

        $procat=Product::orderBy('type')->get();
        return view('admin.pages.tempate.'.$views,compact('procat','template'));
        
    }
    /**
     * Delete Tempate
     * @method deleteTemplate
     * @param id
     */
    public function deleteTemplate(Request $request,$id)
    {
        try{
            Template::where('id',$id)->delete();
             return redirect('admin/template')->with('success','Template deleted successful');
            }catch(\Exception $e){
              
              return back()->with('error',$e->getMessage());
                  
          }
    }
    
}
