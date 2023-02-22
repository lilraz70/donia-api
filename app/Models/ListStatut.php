<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ListStatut extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'list_statuts';

    public static $searchable = [
        'intitule',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'intitule',
        'objecttype_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function objecttype()
    {
        return $this->belongsTo(Objecttype::class, 'objecttype_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
