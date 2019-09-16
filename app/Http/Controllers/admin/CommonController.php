<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class CommonController extends Controller
{
    //
    /**
     * Search data from table using ajax 
     * @method searchData
     * @param null
     */
    
    public function searchData(Request $request)
    {  
        $keywords = $request->inputvalue;
        $table= $request->tablename;
        $baseurl = $request->baseurl;
        $deleteurl = $request->deleteurl;
        $editurl = $request->editurl;
        $columns = $request->columns;
        $joins=array();
        if(!empty($request->joins)){
        $joins = array_filter($request->joins);
        }
      
        // Run query with dynaic column
        $query = DB::table($table)->select($columns); 
        if(count($joins)>0)
            {   
                //print_r(($joins));
                for($i=0; $i<count($joins);$i++){
                $join = explode(',',$joins[$i]);
                //print_r(($join));
                //echo $join[0].',',$table.'.'.$join[1],'=',$join[0].'.id';
              $query->join($join[0],$table.'.'.$join[1],'=',$join[0].'.id');
              //$query->orWhere($joins[2],'LIKE', DB::raw('\'%'.$keywords.'%\''));
            }
           
        }
          for($i=0 ; $i<count($columns);$i++){
            $condition = "'$columns[$i]'" ;
           
            //$columns = array_diff($columns,$joins);
            //print_r($joins); exit;
            
           // print_r($query); 
            $query->orWhere($columns[$i],'LIKE', DB::raw('\'%'.$keywords.'%\''));
            }
       $result = $query->get();
    //   print_r($result);
    //   exit;
       // Bind HTML 
       $html ='';
       if(count($result->toArray())>0):
       
       $indexes= 1 ;foreach($result as $data): // data loop 
       
        //$columns = array_diff($columns,array($columns[0]));
        //print_r($columns); 
        $html.= '<tr>';
        $html.= '<td>'.$indexes.'</td>';
        for($i=1 ; $i<count($columns);$i++){ // Column loop 
            $col=$columns[$i];
            $pos = (strpos($col,'.') >0) ? (strpos($col,'.')+1) : 0;
           
            $col = substr($col,$pos);
           
            
            if($col == 'status'){
                 $statusurl = url('admin/status-update/'.$table.'/'.$data->id);
                $newcol = $data->$col == 1 ? '<a class=" tooltips" href = "'.$statusurl.'"><div class = "btn-group btn btn-success"><i class="icon_check_alt2"></i></div></a>' : '<a class=" tooltips" href = "'.$statusurl.'"><div class = "btn-group btn btn-danger"><i class="icon_close_alt2"></i></div></a>';
               
            }
            elseif($col == 'type'){
                $newcol = $data->$col == 0 ? 'Category' : 'Product';
            }else{
                $newcol =$data->$col;
            }
            
        $html.= '<td>'.$newcol.'</td>';
         }
        $html.='<td> <a class="btn btn-primary tooltips" href="'.$editurl.'/'.$data->id.'" title="Modify detail" data-placement="bottom" data-toggle="tooltip "><i class="icon_pencil_alt"></i></a> ';
        $html.='<a class="btn btn-danger tooltips " href="'.$deleteurl.'/'.$data->id.'" title="Delete" data-placement="bottom" data-toggle="tooltip "><i class="icon_trash"></i></a></td>';
        $html.='</tr>';
        
       $indexes++;
      
    endforeach;
    else:
    $html.= '<tr><td colspan = "4">No Data Found</td></tr>';
    endif;
    // $html.='<tr><td colspan="6">';
    // $html.= '<ul class="pagination pull-right">';
    // //echo $result->render();
    // echo $result->withPath($baseurl);
    // $html.= '</ul>';
    // $html.= '</td></tr>';
     echo $html; 
    exit;
    }

    /**
     * Status update
     * @method updateStatus
     * @param null
     */
    public function updateStatus(Request $request,$tablename ,$id)
    {     
        $result = DB::table($tablename)->where('id',$id)->first();
        
        if($result)
        {
            $status = $result->status == 1 ? 0 : 1;
            DB::table($tablename)->where('id',$id)->update(array('status' => $status));
            return back()->with('success','Status update successful');
        }
        else{
            return back()->with('error','Something went wrong');
        }
    }
}
