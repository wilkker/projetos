<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $casts = [
        'itens' => 'array'
    ];

    protected $guarded = [];

    protected $dates = ['date'];

    public function user(){
        return $this->belongsTo('app\models\User');
    }

    public function users(){
        return $this->belongsToMany('app\models\user');
    }
}
