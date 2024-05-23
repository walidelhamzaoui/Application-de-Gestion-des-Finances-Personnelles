<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Burget;
class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'amount',
        'budget_id',
        'user_id','type','date'
    ];
    public function budget()
    {
        return $this->belongsTo(Budget::class);
    }
}
