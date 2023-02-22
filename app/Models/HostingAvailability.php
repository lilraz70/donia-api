<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HostingAvailability extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'hosting_availabilities';

    protected $dates = [
        'jour_debut',
        'jour_fin',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'jour_debut',
        'heure_debut',
        'jour_fin',
        'heure_fin',
        'lodging_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getJourDebutAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setJourDebutAttribute($value)
    {
        $this->attributes['jour_debut'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getJourFinAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setJourFinAttribute($value)
    {
        $this->attributes['jour_fin'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function lodging()
    {
        return $this->belongsTo(Lodging::class, 'lodging_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
