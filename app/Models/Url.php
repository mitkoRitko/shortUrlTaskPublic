<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Url extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'short_urls';
    protected $fillable = [
        'destination_url',
        'hash'
    ];

    public static function destinationUrlExists($url)
    {
        return static::where('destination_url', $url)->exists();
    }

    public static function hashExists($hash)
    {
        return static::where('hash', $hash)->exists();
    }
}
