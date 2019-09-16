<?php 
if (! function_exists('admindetail')) {
  function admindetail($user_id = null) {
    $data = \DB::table('users')
        ->select('*')
        ->where('id', $user_id)
        ->first();
      
    return $data;
  }
}

if (! function_exists('parentcatname')) {
  function parentcatname($parentid = null) {
    $data = \DB::table('products')
        ->select('name')
        ->where('id', $parentid)
        ->first();
      
        
    return $data;

  }
}
