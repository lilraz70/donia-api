<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Carpool extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'carpools';

    public static $searchable = [
        'paiement',
        'preuve_paiement',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_client_id',
        'user_fournisseur_id',
        'paiement',
        'preuve_paiement',
        'paymentmode_id',
        'mention_arrive',
        'mention_arv_heure',
        'trip_id',
        'liststatut_id',
        'carpoolingvehicle_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user_client()
    {
        return $this->belongsTo(User::class, 'user_client_id');
    }

    public function user_fournisseur()
    {
        return $this->belongsTo(User::class, 'user_fournisseur_id');
    }

    public function paymentmode()
    {
        return $this->belongsTo(PaymentMode::class, 'paymentmode_id');
    }

    public function trip()
    {
        return $this->belongsTo(Trip::class, 'trip_id');
    }

    public function liststatut()
    {
        return $this->belongsTo(ListStatut::class, 'liststatut_id');
    }

    public function carpoolingvehicle()
    {
        return $this->belongsTo(CarpoolingVehicle::class, 'carpoolingvehicle_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
