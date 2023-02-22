<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TripFrequency extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'trip_frequencies';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'day_id',
        'trip_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function day()
    {
        return $this->belongsTo(Day::class, 'day_id');
    }

    public function trip()
    {
        return $this->belongsTo(Trip::class, 'trip_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
