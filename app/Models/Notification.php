<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'notifications';

    public static $searchable = [
        'contenu',
        'sujet',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'contenu',
        'sujet',
        'areasofservice_id',
        'objecttype_id',
        'user_id',
        'object',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function areasofservice()
    {
        return $this->belongsTo(AreasOfService::class, 'areasofservice_id');
    }

    public function objecttype()
    {
        return $this->belongsTo(Objecttype::class, 'objecttype_id');
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
