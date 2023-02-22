<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HostingService extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'hosting_services';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'lodging_id',
        'servicesinclus_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function lodging()
    {
        return $this->belongsTo(Lodging::class, 'lodging_id');
    }

    public function servicesinclus()
    {
        return $this->belongsTo(Servicesinclu::class, 'servicesinclus_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
