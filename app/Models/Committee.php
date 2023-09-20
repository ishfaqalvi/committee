<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Committee
 *
 * @property $id
 * @property $name
 * @property $type
 * @property $amount
 * @property $status
 * @property $user_id
 * @property $created_at
 * @property $updated_at
 *
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Committee extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    static $rules = [
		'name' => 'required',
		'type' => 'required',
		'amount' => 'required',
		'user_id' => 'required'
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','type','amount','status','user_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    
}
