<?php

use Carbon\Carbon;

function createDate($param)
{
    return Carbon::parse($param);
}

function test($param)
{
    $dt = Carbon::parse($param);
    $next = Carbon::parse('2023-03-11');

    return date_diff($dt, $next)->format('%y years, %m months and %d days');
}

function no_docs($param)
{
}
