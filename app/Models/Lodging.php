<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lodging extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'lodgings';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nb_chambre',
        'prix_journalier',
        'prix_mensuel',
        'localisation',
        'geolocalisation',
        'hostingtype_id',
        'typeofhouse_id',
        'setcountry_id',
        'city_id',
        'quartier_id',
        'user_id',
        'liststatut_id',
        'libelle',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function hostingtype()
    {
        return $this->belongsTo(HostingType::class, 'hostingtype_id');
    }

    public function typeofhouse()
    {
        return $this->belongsTo(TypeOfHouse::class, 'typeofhouse_id');
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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
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
