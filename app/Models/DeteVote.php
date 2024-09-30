<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Suggestion;

class DeteVote extends Model
{
    use HasFactory;
    protected $table = 'vote_date';
    protected $fillable = [
        'start_date',
        'end_date',
        'sugges_date_id',
    ];

    public function date()
    {
            return $this->belongsTo(Suggestion::class, 'sugges_date_id');
    }
}
