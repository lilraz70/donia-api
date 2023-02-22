<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NeedVehicle extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'need_vehicles';

    public static $searchable = [
        'finition',
        'nb_place',
        'annee_fabrication',
        'conso_au_100_km',
        'nb_chevaux',
        'nb_cylindre',
        'accessoires',
        'kilometrage',
        'options',
        'pannes_signalees',
        'immatriculation',
    ];

    protected $dates = [
        'date_limite_demande',
        'date_satisfait',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'finition',
        'nb_place',
        'annee_fabrication',
        'conso_au_100_km',
        'nb_chevaux',
        'nb_cylindre',
        'accessoires',
        'kilometrage',
        'options',
        'pannes_signalees',
        'immatriculation',
        'brand_id',
        'modelofvehicle_id',
        'colortype_id',
        'energytype_id',
        'gearbox_id',
        'vehicletype_id',
        'typeofutility_id',
        'motricitytype_id',
        'typeofwheel_id',
        'rimtype_id',
        'listofcountry_id',
        'user_id',
        'liststatut_id',
        'typeoffer_id',
        'budget_max_achat',
        'budget_max_location',
        'description',
        'libelle',
        'emergencylevel_id',
        'date_limite_demande',
        'satisfait',
        'date_satisfait',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function modelofvehicle()
    {
        return $this->belongsTo(ModelOfVehicle::class, 'modelofvehicle_id');
    }

    public function colortype()
    {
        return $this->belongsTo(ColorType::class, 'colortype_id');
    }

    public function energytype()
    {
        return $this->belongsTo(EnergyType::class, 'energytype_id');
    }

    public function gearbox()
    {
        return $this->belongsTo(GearBox::class, 'gearbox_id');
    }

    public function vehicletype()
    {
        return $this->belongsTo(VehicleType::class, 'vehicletype_id');
    }

    public function typeofutility()
    {
        return $this->belongsTo(TypeOfUtility::class, 'typeofutility_id');
    }

    public function motricitytype()
    {
        return $this->belongsTo(MotricityType::class, 'motricitytype_id');
    }

    public function typeofwheel()
    {
        return $this->belongsTo(TypeOfWheel::class, 'typeofwheel_id');
    }

    public function rimtype()
    {
        return $this->belongsTo(RimType::class, 'rimtype_id');
    }

    public function listofcountry()
    {
        return $this->belongsTo(ListOfCountry::class, 'listofcountry_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function liststatut()
    {
        return $this->belongsTo(ListStatut::class, 'liststatut_id');
    }

    public function typeoffer()
    {
        return $this->belongsTo(TypeOffer::class, 'typeoffer_id');
    }

    public function emergencylevel()
    {
        return $this->belongsTo(EmergencyLevel::class, 'emergencylevel_id');
    }

    public function getDateLimiteDemandeAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateLimiteDemandeAttribute($value)
    {
        $this->attributes['date_limite_demande'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
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
