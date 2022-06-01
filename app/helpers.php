<?php

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

function upload($file, $dir = 'public/products'): string
{
//   return Storage::disk('local')->put($dir, $file);
   return $file->store($dir);
}

/**
 * @throws Exception
 */
function interval($startTime, $endTime): DateInterval
{
    $d1 = new DateTime($startTime);
    $d2 = new DateTime($endTime);
    return $d1->diff($d2);
}

function getIntervalSessionForProduct($difference): array
{
    if ($difference->y > 0 || $difference->m > 0 || $difference->d > 0) return [ 'H' => 0, 'M' => 0 ];
    return [
        'H' => (11 - $difference->h),
        'M' => (60 - $difference->i)
    ];
}
