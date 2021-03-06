<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clicks extends Model
{
    use HasFactory;

    protected $fillable = ["article_id", "number_clicks"];
}