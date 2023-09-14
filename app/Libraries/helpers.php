<?php

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
 
    $path = 'upload/images/'.$path;
    $finalPath = $path.$name;
    $file->move($path, $name);

    Image::load($finalPath)->fit(Manipulations::FIT_CROP, $width, $height)->save(public_path($finalPath));
    return $finalPath;
}