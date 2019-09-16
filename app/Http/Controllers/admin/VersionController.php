<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Template;
use App\Location;
use App\Version;
class VersionController extends Controller
{
    //
    /**
     * Create Template and mapping with location 
     * @method create
     * @param null
     */
    public function create(Request $request , $id = null)
    {   
        if ($request->isMethod('post')) {
            $data = $request->all();
            for($i = 0 ; $i<count($request->city);$i++){
               
                $data['city']=$request->city[$i];
                 //echo "<pre>"; print_r($data);
                Version::updateOrCreate(['id'=>$id],$data);
            }
           exit;
        }
        $addedlocation = Version::all();
        foreach ($addedlocation as $added) {
                    $list[] = $added->city;
                }
        $version = Template::orderBy('version')->where('is_default','0')->get();
       
        $locations = Location::orderBy('name')->whereNotIn('id',$list)->get();
        
        return view('admin.pages.version.create_version',compact('version','locations'));
    }
}
