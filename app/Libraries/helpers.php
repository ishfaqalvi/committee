<?php


use Carbon\Carbon;
use App\Models\Setting;
use Spatie\Image\Image;
use Spatie\Image\Manipulations;
use Spatie\Permission\Models\Role;

/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function uploadFile($file, $path, $width, $height)
{
    $extension = $file->getClientOriginalExtension();
    $name = uniqid().".".$extension;
 
    $folder = 'images/'.$path;
    $finalPath = $folder.'/'.$name;
    $file->move($folder, $name);

    Image::load($finalPath)->fit(Manipulations::FIT_CROP, $width, $height)->save(public_path($finalPath));
    return $finalPath;
}

/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function settings($key)
{
    return Setting::get($key);
}

/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function getPermissons($user)
{
    $permissions = array();
    foreach ($user->roles->pluck('id') as $id) {
        $role = Role::find($id);
        $permissions = array_merge($permissions, $role->permissions->pluck('name')->toArray());
    }
    return array_unique($permissions);
}

/**
 * Add listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function addIntervalPayments($interval)
{
    $user = $interval->user;
    $committee = $interval->committee; 
    foreach($committee->intervals()->pluck('user_id') as $member){
        if ($member == $user->id) {
            $data = ['user_id' => $member, 'date' => date('Y-m-d'), 'status' => 'Submitted'];
            $interval->increment('receivable', $committee->amount);
        }else{
            $data = ['user_id' => $member];   
        }
        $interval->payments()->create($data);
    }
    $interval->update([
        'start_date' => date('Y-m-d'), 
        'close_date' => Carbon::now()->addDays($committee->collection_days)
    ]);
}