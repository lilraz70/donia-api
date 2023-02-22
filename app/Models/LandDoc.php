<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LandDoc extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'land_docs';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'land_id',
        'typeadmdoc_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function land()
    {
        return $this->belongsTo(Land::class, 'land_id');
    }

    public function typeadmdoc()
    {
        return $this->belongsTo(TypeAdmDoc::class, 'typeadmdoc_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
