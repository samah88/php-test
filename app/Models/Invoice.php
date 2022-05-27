<?php

namespace App\Models;
use Illuminate\Support\Str;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $guarded=[];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($invoice) {
            $invoice->uuid = (string) Str::uuid();
        });

    }
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
