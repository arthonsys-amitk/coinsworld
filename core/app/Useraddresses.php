<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Useraddresses extends Model
{
    protected $table = 'useraddresses';
    protected $fillable = array( 'user_id','address', 'address_label','is_archived');

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
