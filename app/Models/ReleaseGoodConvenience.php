<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReleaseGoodConvenience extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'release_good_conveniences';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'releasegood_id',
        'conveniencetype_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'number',
    ];

    public function releasegood()
    {
        return $this->belongsTo(ReleaseGood::class, 'releasegood_id');
    }

    public function conveniencetype()
    {
        return $this->belongsTo(ConvenienceType::class, 'conveniencetype_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
