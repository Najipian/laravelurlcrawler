<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    //
    protected $table = 'Links';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url_id' , 'link_name'
    ];

    public function Url(){
        return $this->belongsTo('App\App');
    }
}
