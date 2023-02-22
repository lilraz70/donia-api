<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'cities';

    public static $searchable = [
        'intitule',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'intitule',
        'set_countries_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function cityQuartiers()
    {
        return $this->hasMany(Quartier::class, 'city_id', 'id');
    }

    public function set_countries()
    {
        return $this->belongsTo(SetCountry::class, 'set_countries_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
