<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Submission
 *
 * @property $id
 * @property $committee_member_id
 * @property $user_id
 * @property $date
 * @property $remarks
 * @property $attachment
 * @property $tags
 * @property $approval
 * @property $status
 * @property $created_at
 * @property $updated_at
 *
 * @property CommitteeMember $committeeMember
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Submission extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['committee_member_id','user_id','tags','status'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function committeeMember()
    {
        return $this->hasOne('App\Models\CommitteeMember', 'id', 'committee_member_id');
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
        return $this->hasMany('App\Models\Payment', 'submission_id', 'id');
    }
}
