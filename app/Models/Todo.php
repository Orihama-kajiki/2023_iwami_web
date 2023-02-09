<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;
    protected $guarded = array('id');

    
    public static function doSearch($keyword, $tag_id)
    {
        $query = self::query();
        if (!empty($keyword)) {
        $query->where('content', 'like', "%$keyword%");
        }

        if (!empty($tag_id)) {
        $query->where('tag_id', $tag_id);
        }
        $todos = $query->get();
        return $todos;
    }

    public function tag()
    {
    return $this->belongsTo('App\Models\Tag');
    }
    public function user()
    {
    return $this->belongsTo('App\Models\User');
    }
}
