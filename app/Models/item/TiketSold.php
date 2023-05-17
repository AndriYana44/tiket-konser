<?php

namespace App\Models\item;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiketSold extends Model
{
    use HasFactory;

    protected $table = 'data_tiket_sold';
    protected $fillable = [
        'tiket_number',
        'type',
        'price',
        'is_checkin'
    ];
}
