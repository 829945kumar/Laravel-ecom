<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodayDeals extends Model
{
    use HasFactory;
    protected $table = "today_deals";
    protected $primaryKey = "id";
}
