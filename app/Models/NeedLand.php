<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NeedLand extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'need_lands';

    protected $dates = [
        'date_satisfait',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'superficie',
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
        'landcategory_id',
        'libelle',
        'emergencylevel_id',
        'satisfait',
        'date_satisfait',
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

    public function landcategory()
    {
        return $this->belongsTo(LandCategory::class, 'landcategory_id');
    }

    public function emergencylevel()
    {
        return $this->belongsTo(EmergencyLevel::class, 'emergencylevel_id');
    }

    public function getDateSatisfaitAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateSatisfaitAttribute($value)
    {
        $this->attributes['date_satisfait'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
