<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $table = "promo";
    protected $guarded = ["id"];
    use HasFactory;

    public static function findByCode($kode)
    {
        return self::where('kode', $kode)->first();
    }

    public function discount($total)
    {
        return $this->diskon * $total;
    }

    public function Rent(){
        return $this->hasMany(Rent::class);
    }
    public function Owner()
    {
        return $this->belongsTo(Owner::class);
    }
}
