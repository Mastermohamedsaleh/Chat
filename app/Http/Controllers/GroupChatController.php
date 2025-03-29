<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GroupMember;
use App\Models\Group;

class GroupChatController extends Controller
{
    
      
    public function creategroup(Request $req)
    {
        Group::create([
            'name'=> $req->name
        ]);
        


        $namemembers = $req->namemembers;
        $group = $req->name->id;

        for($i =0 ; $i < count($namemembers) ; $i++){
            $insert = [
              'user_id' => $namemembers[$i],
              'group_id' => $group[$i],
            ];
           DB::table('group_members')->insert($insert);
      }  
      return redirect()->back();





    }
     
}
