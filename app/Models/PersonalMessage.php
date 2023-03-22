<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalMessage extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'header',
        'message',
        'occasion',
    ];

    public function scopeByOccasion(Builder $query, string $occasion): Builder
    {
        return $query->where('occasion', '=', $occasion);
    }
}
