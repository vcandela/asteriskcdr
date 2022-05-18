<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CDRAsterisk extends Model
{
    use HasFactory;
    protected $connection= 'mariadbCDR';
    protected $table = "cdr";
    protected $fillable = [];
    protected $dates = [
        'calldate',
    ];
}
