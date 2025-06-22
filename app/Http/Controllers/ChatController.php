<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\MessageSent;
use App\Events\UserTyping;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Interfaces\ChatRepositoryInterface;


class ChatController extends Controller
{


    private $Chat;

    public function __construct(ChatRepositoryInterface $Chat)
    {
       return $this->Chat = $Chat;
        
    }



    public function index()
    {
      return  $this->Chat->index();
    }


    public function chat($receiverId)
    {
    return   $this->Chat->chat($receiverId); 
    }

    public function sendMessage(Request $request, $receiverId)
    {
      return $this->Chat->sendMessage($request, $receiverId); 
    }


    public function typing()
    {
      return $this->Chat->typing();
    }




}
