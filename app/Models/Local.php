<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Local extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'locals';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nb_chambre',
        'localisation',
        'geolocalisation',
        'user_id',
        'propertytype_id',
        'typeoffer_id',
        'setcountry_id',
        'city_id',
        'quartier_id',
        'prix_vente',
        'prix_location',
        'condition_location',
        'condition_vente',
        'liststatut_id',
        'description',
        'libelle',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function propertytype()
    {
        return $this->belongsTo(PropertyType::class, 'propertytype_id');
    }

    public function typeoffer()
    {
        return $this->belongsTo(TypeOffer::class, 'typeoffer_id');
    }

    public function setcountry()
    {
        return $this->belongsTo(SetCountry::class, 'setcountry_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function quartier()
    {
        return $this->belongsTo(Quartier::class, 'quartier_id');
    }

    public function liststatut()
    {
        return $this->belongsTo(ListStatut::class, 'liststatut_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
