<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Payment
 *
 * @property $id
 * @property $interval_id
 * @property $user_id
 * @property $date
 * @property $remarks
 * @property $attachment
 * @property $status
 * @property $created_at
 * @property $updated_at
 *
 * @property Interval $interval
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Payment extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['interval_id','user_id','date','remarks','attachment','status'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function interval()
    {
        return $this->hasOne('App\Models\Interval', 'id', 'interval_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
}
