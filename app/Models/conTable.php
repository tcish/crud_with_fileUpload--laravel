<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class conTable extends Model
{
    use HasFactory;

    protected $table = "tbl_log_reg";
    public $timestamps = false;
}
