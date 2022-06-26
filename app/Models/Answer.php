<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        ];
        
        
    public function Question()
    {
        return $this->belongsTo(Question::class);
    }
    
    public static function answers_getAllOrderByUpdated_at()
    {
        return self::orderBy('updated_at', 'desc')->get();
    }

    
}
