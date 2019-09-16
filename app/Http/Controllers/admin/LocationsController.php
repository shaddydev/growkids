<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Location;
use Illuminate\Support\Str;
Use Exception;
Use Response;
use DB;
class LocationsController extends Controller
{   
    /**
     * view all location 
     * @method index
     * @param null
     */
    public function index()
    {    
        $locations = Location::OrderBy('name')->paginate(10);
        return view('admin.pages.location.locations',compact('locations'));
    }
    
    /**
     * Create Location
     * @method create
     * @param null
     */
    public function create(Request $request,$id= null)
    {   
        if($id){ $location = Location::find($id);}
      
        $views = !empty($id) ? 'edit_location' : 'add_location';
        if ($request->isMethod('post')) {
            $validatedData = $request->validate([
            'name' => 'required|regex:/^[a-zA-Z-_ ]+$/u',
            
        ]);
        
        $data = $request->all();
        $check_deault = Location::all();
        if(!empty($request->is_default)){
            foreach($check_deault as $default){
            //echo $default->id;
            Location::where('id',$default->id)->update(array('is_default'=>'0'));
           
            } 
         }
        
        $data['slug'] = Str::slug($request->slug == '' ? $request->name:$request->slug);
        $data['status'] =  $request->status != '' ? '1' : '0';
        $location = Location::updateOrCreate(['id' => $id],$data);
            if($location){
                return redirect('admin/locations')->with('success','Location Added successful');
            } 
            else{
                return redirect('admin/locations/add-location')->with('error','Something went wrong');
            }
         }
        return view('admin.pages.location.'.$views,compact('location'));
    }
    /**
     * Delete Location 
     * @method deleteLocation
     * @param null
     */
    public function deleteLocation(Request $request,$id = null)
    {
       $delete = Location::where('id',$id)->delete();
       return redirect('admin/locations')->with('success','Location deleted successful');
    }

}
