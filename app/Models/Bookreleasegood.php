<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bookreleasegood extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const CONFIRMATION_RADIO = [
        '1' => 'Oui',
        '0' => 'Non',
    ];

    public $table = 'bookreleasegoods';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'releasegood_id',
        'user_id',
        'confirmation',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function releasegood()
    {
        return $this->belongsTo(ReleaseGood::class, 'releasegood_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
