<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public $table = "status";
    public $primaryKey = 'id';
    public $incrementing = true;
    public $timestamp = false;
}
