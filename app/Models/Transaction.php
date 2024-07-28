<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = ['amount', 'category_id', 'user_id', 'description', 'type', 'transaction_date'];

    protected $casts = [
        'transaction_date' => 'datetime'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function seedTransactions()
    {
        Artisan::call('db:seed', ['--class' => 'TransactionSeeder']);
    }
}
