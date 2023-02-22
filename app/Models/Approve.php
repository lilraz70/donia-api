<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Approve extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'approves';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'comment',
        'objet',
        'user_id',
        'objecttype_id',
        'reason_id',
        'resultat',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function objecttype()
    {
        return $this->belongsTo(Objecttype::class, 'objecttype_id');
    }

    public function reason()
    {
        return $this->belongsTo(Reason::class, 'reason_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
