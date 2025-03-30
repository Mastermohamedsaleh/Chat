<?php

namespace App\Http\Controllers;
use App\Events\GrouptoMessage;
use Illuminate\Http\Request;
use App\Models\GroupMember;
use App\Models\Group;
use App\Models\GroupMessage;

use Illuminate\Support\Facades\DB;

class GroupChatController extends Controller
{
    
      


     public function index($groupId)
     { 
        $messages = GroupMessage::where('group_id', $groupId)
        ->with('user') // جلب معلومات المستخدم المرسل
        ->orderBy('created_at', 'asc') // ترتيب الرسائل حسب الأقدمية
        ->get();
         return view('chatgroup',compact('messages','groupId'));
     }




    public function create(Request $request)
    {
        $group = new Group();
        $group->name = $request->name;
        $group->save();
        $id_group = $group->id;

        $userIds = $request->input('user_ids'); // استلام جميع الـ ID's المختارة

        if ($userIds) {
            foreach ($userIds as $id) {
                DB::table('group_members')->insert([
                     'user_id' => $id,
                     'group_id'=>$id_group
                ]);
            }
        }
    
        return redirect()->back()->with('success', 'تمت الإضافة بنجاح!');
    }


    public function sendMessage(Request $request , $groupId)
    {
        $message = GroupMessage::create([
            'group_id' => $groupId,
            'user_id' => auth()->id(),
            'message' => $request->message
        ]);


        $message->load('user');

        event(new GrouptoMessage($message));;

        return response()->json($message);
    }
     
}
