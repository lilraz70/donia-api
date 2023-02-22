<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trip extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'trips';

    public static $searchable = [
        'intitule',
        'lieu_depart',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'intitule',
        'lieu_depart',
        'heure_depart',
        'lieu_arrive',
        'heure_arrive',
        'liststatut_id',
        'cout',
        'user_id',
        'typeoftrip_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function liststatut()
    {
        return $this->belongsTo(ListStatut::class, 'liststatut_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function typeoftrip()
    {
        return $this->belongsTo(TypeOfTrip::class, 'typeoftrip_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
