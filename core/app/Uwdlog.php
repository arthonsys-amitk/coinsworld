<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Uwdlog extends Model
{
    protected $table = 'uwdlogs';
	
	protected $fillable = array('user_id', 'trxid', 'amount','balance','toacc','charge','commission','blockio_fee','flag','status', 'desc');
	
	public function user()
    {
        return $this->belongsTo('App\User');
    }
}
