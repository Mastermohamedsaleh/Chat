<?php
 
namespace App\Interfaces;


interface ChatRepositoryInterface 
{

 
    public function index();

    public function chat($receiverId);
     
    public function sendMessage(Request $request, $receiverId);

    public function typing();

}