<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Posts extends Model
{
  use SoftDeletes;

  protected $fillable = ['judul', 'category_id', 'content', 'gambar', 'slug', 'user_id'];

  protected $table = 'posts';

  public function category()
  {
    return $this->belongsTo('App\Category'); // hanya dapat memiliki satu category
  }

  public function tags()
  {
    return $this->belongsToMany('App\Tags'); // dapat memiliki banyak tags
  }

  public function users()
  {
    return $this->belongsTo('App\User', 'user_id');
  }

}