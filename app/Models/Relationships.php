<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Relationships extends Model
{
    protected $table = "typecho_relationships";

    public function content(){
        return $this->hasOne('App\Models\Content', 'cid', 'cid');
    }
}