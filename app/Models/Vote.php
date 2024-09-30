<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\UserVote;

class Vote extends Model
{
    use HasFactory;
    protected $table ='vote';
    protected $fillable = ['vote'];

    public function user_vote(): HasMany {
        return $this->hasMany(UserVote::class);
    }
}
