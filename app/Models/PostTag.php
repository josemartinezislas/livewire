<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//=======| MODELO NUEVO |==========
class PostTag extends Model
{
    use HasFactory;
    
    protected $fillable=['post_id','tag_id' ];

    public function posts(){
        return $this->hasMany(Post::class);
    }
    
}
