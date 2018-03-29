<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BrowserSessions extends Model
{
    protected $table = 'browser_sessions';
    protected $fillable = array( 'user_id','platform', 'browser','ip_address');

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
