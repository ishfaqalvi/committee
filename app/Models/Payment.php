<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Payment
 *
 * @property $id
 * @property $submission_id
 * @property $date
 * @property $remarks
 * @property $attachment
 * @property $status
 * @property $created_at
 * @property $updated_at
 *
 * @property Submission $submission
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
    protected $fillable = ['submission_id','amount','date','remarks','attachment','status'];

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
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function submission()
    {
        return $this->hasOne('App\Models\Submission', 'id', 'submission_id');
    }
}
