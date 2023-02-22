<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LocalConvenience extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'local_conveniences';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'local_id',
        'conveniencetype_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function local()
    {
        return $this->belongsTo(Local::class, 'local_id');
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
