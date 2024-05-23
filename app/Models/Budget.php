<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Transaction;
class Budget extends Model
{
    use HasFactory;
    protected $fillable = [
        'category',
        'user_id',
        'max_amount',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
  // Dans votre modèle Budget

public function transactions()
{
    return $this->hasMany(Transaction::class);
}

}
