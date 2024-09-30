<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Problem extends Model
{
    use HasFactory;
    protected $table = 'problem';
    protected $fillable = ['problem_name','p_img','p_detail','p_location','p_date','user_p_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_p_id');
    }
}
