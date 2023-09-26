<?php


use App\Models\Setting;
use Spatie\Image\Image;
use Spatie\Image\Manipulations;

/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function uploadFile($file, $path, $width, $height)
{
    $extension = $file->getClientOriginalExtension();
    $name = uniqid().".".$extension;
 
    $folder = 'upload/images/'.$path;
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
}