<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserVote;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Suggestion extends Model
{
    use HasFactory;
    protected $table = 'suggestion';
    protected $fillable = ['topic_name',
                            's_detail',
                            'start_date',
                            'end_date',
                            'user_s_id'];


    public function user_vote(): HasMany {
        return $this->hasMany(UserVote::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_s_id');
    }

}
