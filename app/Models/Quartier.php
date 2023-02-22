<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quartier extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'quartiers';

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
        'city_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function set_countries()
    {
        return $this->belongsTo(SetCountry::class, 'set_countries_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
