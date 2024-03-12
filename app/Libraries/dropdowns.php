<?php

use App\Models\{User};

/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function members()
{
    return User::whereHas('roles', function($q){$q->whereIn('name', ['Manager','Member']);})->pluck('mobile_number','id');
}