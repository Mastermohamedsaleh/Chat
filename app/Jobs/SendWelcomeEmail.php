<?php

namespace App\Jobs;

use App\Models\User;
use App\Mail\WelcomeMail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendWelcomeEmail implements ShouldQueue
{
     use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }


    public function handle(): void
    {
       Mail::to($this->user->email)->send(new WelcomeMail($this->user));
            //    \Log::info("I'm Log i Proccess Your Images");
    }
}
