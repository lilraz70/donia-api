<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Image;
use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReleaseGood extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const LOYER_AUGMENTERA_RADIO = [
        '1' => 'Oui',
        '0' => 'Non',
    ];

    public const VERIF_ACCORD_BAILLEUR_RADIO = [
        '1' => 'Oui',
        '0' => 'Non',
    ];

    public $table = 'release_goods';

    public static $searchable = [
        'conditions_bailleur',
        'localisation',
        'contact_bailleur',
    ];

    protected $dates = [
        'date_sorti_prevu',
        'date_limite',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'date_sorti_prevu',
        'conditions_bailleur',
        'commentaires',
        'nb_chambre',
        'localisation',
        'geolocalisation',
        'date_limite',
        'contact_bailleur',
        'accord_bailleur',
        'propertytype_id',
        'setcountry_id',
        'city_id',
        'quartier_id',
        'user_id',
        'liststatut_id',
        'emergencylevel_id',
        'libelle',
        'verif_accord_bailleur',
        'cout',
        'loyer_augmentera',
        'created_at',
        'updated_at',
        'deleted_at',
        'image_url'
    ];

    public function getDateSortiPrevuAttribute($value)
    {
        //return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;

                //return $value ? Carbon::createFromFormat('Y-m-d', $value)->format('Y-m-d');
                //return Carbon::createFromFormat('Y-m-d', $value)->format('Y-m-d');
                return $value;
    }


    public function setDateSortiPrevuAttribute($value)
    {
        //$this->attributes['date_sorti_prevu'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
        //$this->attributes['date_sorti_prevu'] = Carbon::createFromFormat('Y-m-d', $value)->format('Y-m-d');
        $this->attributes['date_sorti_prevu'] = $value;
    }

    public function getDateLimiteAttribute($value)
    {
        //return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
        return $value;
    }

    public function setDateLimiteAttribute($value)
    {
        //$this->attributes['date_limite'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
        $this->attributes['date_limite'] = $value;
    }

    public function propertytype()
    {
        return $this->belongsTo(PropertyType::class, 'propertytype_id');
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

    public function releasegoodconvenience()
    {
        return $this->hasMany(ReleaseGoodConvenience::class, 'releasegood_id')->with('conveniencetype');
    }

    public function emergencylevel()
    {
        return $this->belongsTo(EmergencyLevel::class, 'emergencylevel_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
