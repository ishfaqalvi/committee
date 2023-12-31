<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Interval
 *
 * @property $id
 * @property $committee_id
 * @property $user_id
 * @property $order
 * @property $ammount
 * @property $status
 * @property $created_at
 * @property $updated_at
 *
 * @property Committee $committee
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Interval extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;


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
        'order',
        'payable',
        'receivable',
        'status'
    ];

    /**
     * Boot method to increament in order.
     */
    protected static function booted()
    {
        static::creating(function ($interval) {
            $highestOrder = static::max('order');
            $interval->order = $highestOrder + 1;
        });
    }

    /**
     * Scope model query.
     *
     * @var array
     */
    public function scopePending($query)
    {
        return $query->where('status','Pending');
    }/**
     * Scope model query.
     *
     * @var array
     */
    public function scopeActive($query)
    {
        return $query->where('status','Active');
    }

    /**
     * Scope model query.
     *
     * @var array
     */
    public function scopeClosed($query)
    {
        return $query->where('status','Closed');
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
    public function payments()
    {
        return $this->hasMany('App\Models\Payment', 'interval_id', 'id');
    }
}
