<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    use HasFactory;

    protected $table = "trades";
    protected $guarded = [];

    public function coin()
    {
        return $this->belongsTo(Coin::class, "coin_id");
    }
}
