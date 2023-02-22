<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'comments';

    public static $searchable = [
        'contenu',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'contenu',
        'objecttype_id',
        'areasofservice_id',
        'objet',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function objecttype()
    {
        return $this->belongsTo(Objecttype::class, 'objecttype_id');
    }

    public function areasofservice()
    {
        return $this->belongsTo(AreasOfService::class, 'areasofservice_id');
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
