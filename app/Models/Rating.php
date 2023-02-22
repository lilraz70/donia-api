<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rating extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'ratings';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'areasofservices_id',
        'objecttype_id',
        'user_id',
        'ratingtype_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function areasofservices()
    {
        return $this->belongsTo(AreasOfService::class, 'areasofservices_id');
    }

    public function objecttype()
    {
        return $this->belongsTo(Objecttype::class, 'objecttype_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function ratingtype()
    {
        return $this->belongsTo(RatingType::class, 'ratingtype_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
