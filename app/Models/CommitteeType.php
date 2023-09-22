<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CommitteeType
 *
 * @property $id
 * @property $name
 * @property $type
 * @property $duration_days
 * @property $created_at
 * @property $updated_at
 *
 * @property Committee[] $committees
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class CommitteeType extends Model
{

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','type','duration_days'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function committees()
    {
        return $this->hasMany('App\Models\Committee', 'committee_type_id', 'id');
    }
    
    /**
     * Interact with the duration days.
     */
    public function setDurationDaysAttribute($value)
    {
        $type = $this->attributes['type'];

        if ($type == '1 Week') {
            $days = 7 ;
        } elseif($type == '2 Week'){
            $days = 14;
        } elseif($type == '2 Week'){
            $days = 14;
        } elseif($type == '1 Month'){
            $days = 30;
        } elseif($type == '2 Month'){
            $days = 60;
        } elseif($type == '3 Month'){
            $days = 90;
        } elseif($type == '6 Month'){
            $days = 180;
        } elseif($type == '1 Year'){
            $days = 365;
        } else {
            $days = $value;
        }
        $this->attributes['duration_days'] = $days;
    }
}
