<?php

namespace App\Models\item;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    use HasFactory;
    protected $table = 'data_tiket';
    protected $fillable = [
        'tiket_number',
        'type',
        'price'
    ];
}
