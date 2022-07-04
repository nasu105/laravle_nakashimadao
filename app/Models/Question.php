<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Question extends Model
{
    use HasFactory;
    
    
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];
    
    public static function getAllOrderByUpdated_at()
    {
        return self::orderBy('updated_at', 'desc')->get();
    }
    
    
    public function user() 
    {
        return $this->belongsTo(User::class);
    }
    
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
    
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
    
    public static function answers_getAllOrderByUpdated_at()
    {
        return self::orderBy('updated_at', 'desc')->get();
    }
    
    public function question_answers()
    {
        return $this->belongsToMany(Answer::class);
    }
    
    // public static function getAllOrderByend_question()
    // {
    //     return $this->hasMany(Answer::class)->where('bestasnwer', true)->firstOrFail();
    //     return self::
    // }
    
    // public static function bestanswer()
    // {
    //     return $this->hasMany(Answer::class)->where('bestanswer', true)->firstOrFail();
    //     // return self::whereRelation('answers', 'bestanswer', true)->first();
    // }
    
    // public static function getanswers()
    // {
    //     return $this 
    //         ->with('answers')
    //         ->$question::find($id)
    //         ->where('bestanswer', true)
    //         ->first();
    // }
    
    //  public function getSearchResult(): SearchResult
    // {
    //     // A.検索結果のリンク先となるルートを入れる
    //   $url = route('search.show', $this->id);
    
    //     return new SearchResult(
    //       $this,
    //     //    B.検索結果で表示したいカラムを入れる
    //       $this->question,
    //       $url
    //     );
    // }
}
