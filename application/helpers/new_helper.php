<?php
function atlSong()
{
    return 'ok';
}

function dd($param)
{
    echo json_encode($param);
    die;
}

if (!function_exists('changeDateFormat')) {
    function changeDateFormat($format = 'd-m-Y', $originalDate)
    {
        return date($format, strtotime($originalDate));
    }
}

function activeMenu($segment_1, $segment_2)
{
    if ($segment_1 == 'kategori' && $segment_2 == 1) {
        return 'active';
    }

    if ($segment_1 == 'subkategori') {
        return 'active';
    }
}
