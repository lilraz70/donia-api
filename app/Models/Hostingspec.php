<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hostingspec extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'hostingspecs';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'lodging_id',
        'conveniencetype_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function lodging()
    {
        return $this->belongsTo(Lodging::class, 'lodging_id');
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
