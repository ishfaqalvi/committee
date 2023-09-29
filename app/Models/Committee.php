<?php

namespace App\Models;
use Carbon\Carbon;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Committee
 *
 * @property $id
 * @property $name
 * @property $description
 * @property $created_by
 * @property $committee_type_id
 * @property $status
 * @property $start_date
 * @property $end_date
 * @property $created_at
 * @property $updated_at
 *
 * @property CommitteeType $committeeType
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Committee extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'committee_type_id',
        'created_by',
        'name',
        'collection_days',
        'amount',
        'start_date',
        'end_date',
        'approval',
        'status',
        'description'
    ];

    /**
     * Interact with the duration days.
     */
    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = strtotime($value);
    }

    /**
     * Scope model query.
     *
     * @var array
     */
    public function scopeUserRoleWise($query)
    {
        $user = auth()->user();
        if ($user->hasRole(2)) {
            $query->where('created_by', $user->id);
        }
        elseif($user->hasRole(3)){
            $query->whereHas('intervals', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        }
        return $query;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function committeeType()
    {
        return $this->hasOne('App\Models\CommitteeType', 'id', 'committee_type_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'created_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function intervals()
    {
        return $this->hasMany('App\Models\Interval', 'committee_id', 'id');
    }
}
