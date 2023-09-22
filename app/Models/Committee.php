<?php

namespace App\Models;
use Carbon\Carbon;

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
class Committee extends Model
{
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'created_by',
        'committee_type_id',
        'collection_days',
        'status',
        'start_date',
        'end_date'
    ];

    /**
     * Interact with the duration days.
     */
    public function setStartDateAttribute($value)
    {
        $date = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');

        $this->attributes['start_date'] = $date;
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
}
