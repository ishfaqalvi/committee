<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class CommitteeMember
 *
 * @property $id
 * @property $committee_id
 * @property $user_id
 * @property $start_date
 * @property $close_date
 * @property $due_date
 * @property $order
 * @property $payable
 * @property $receivable
 * @property $status
 * @property $created_at
 * @property $updated_at
 *
 * @property Committee $committee
 * @property Submission[] $submissions
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class CommitteeMember extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'committee_id',
        'user_id',
        'start_date',
        'close_date',
        'due_date',
        'order',
        'payable',
        'receivable',
        'role',
        'status'
    ];

    /**
     * Boot method to increament in order.
     */
    protected static function booted()
    {
        static::creating(function ($model) {
            $highestOrder = static::max('order');
            $model->order = $highestOrder + 1;
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function committee()
    {
        return $this->hasOne('App\Models\Committee', 'id', 'committee_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function submissions()
    {
        return $this->hasMany('App\Models\Submission', 'committee_member_id', 'id');
    }
}