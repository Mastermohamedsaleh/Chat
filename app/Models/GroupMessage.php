<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupMessage extends Model
{
    protected $fillable = ['user_id','group_id','message'];

        // العلاقة مع المستخدم (User)
        public function user()
        {
            return $this->belongsTo(User::class);
        }

}
