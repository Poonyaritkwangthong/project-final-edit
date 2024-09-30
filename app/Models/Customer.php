<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customer';
    protected $fillable = ['f_name','l_name','c_img','phone_n','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
