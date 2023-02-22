<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SetCountry extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const STATUT_SELECT = [
        '1' => 'Activé',
        '0' => 'Désactivé',
    ];

    public $table = 'set_countries';

    public static $searchable = [
        'intitule',
        'code',
        'prefix',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'intitule',
        'code',
        'prefix',
        'flag',
        'statut',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function setCountriesCities()
    {
        return $this->hasMany(City::class, 'set_countries_id', 'id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
