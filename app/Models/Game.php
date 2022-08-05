<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Game extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'home',
        'away',
        'date',
        'time',
        'status',
        'home_score',
        'away_score',
        'winner'
    ];

    public function homeTeam(): HasOne
    {
        return $this->hasOne(Team::class, 'id',  'home');
    }

    public function awayTeam(): HasOne
    {
        return $this->hasOne(Team::class, 'id',  'away');
    }

    public function goals(): HasMany
    {
        return $this->hasMany(Goal::class, 'game_id');
    }

    public function getSchedule(): string
    {
        return $this->attributes['date'] . " " . $this->attributes['time'];
    }
}
