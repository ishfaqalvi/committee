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
    protected $fillable = [
        'interval_id',
        'user_id',
        'date',
        'remarks',
        'attachment',
        'tags',
        'approval',
        'status'
    ];

    /**
     * Interact with the duration days.
     */
    public function setDateAttribute($value)
    {
        $this->attributes['date'] = strtotime($value);
    }

    /**
     * The set attributes.
     *
     * @var array
     */
    public function setAttachmentAttribute($image)
    {
        if ($image) {
            $name = time().$image->getClientOriginalName();
            $image->move('images/payments', $name);
            $this->attributes['attachment'] = 'images/payments/'.$name;
        }else {
            unset($this->attributes['attachment']);
        }
    }

    /**
     * The get attributes.
     *
     * @var array
     */
    public function getAttachmentAttribute($image)
    {
        if (isset($image)) { return asset($image); }
    }

    /**
     * Scope model query.
     *
     * @var array
     */
    public function scopeUserWise($query)
    {
        $user = auth()->user();
        if ($user->id != 1) {
            $query->where('user_id', $user->id);
        }
        return $query;
    }

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
