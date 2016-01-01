<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $fillable = [
        'name',
        'ip',
        'port',
        'email',
        'rec_id_a',
        'rec_id_srv'
    ];
}
