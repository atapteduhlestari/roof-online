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

function setNoDoc($no_doc)
{
    $name = "ATL-HO-SOP-GAN";

    $arrNoDoc = explode('-',  $no_doc);
    $first = (int) $arrNoDoc[count($arrNoDoc) - 2];
    $second = (int) end($arrNoDoc);

    if ($second >= 4) {
        $first += 1;
        $second = 0;
    }

    $second += 1;

    //Final No Document
    $firstDoc = sprintf('%02d', $first);
    $secondDoc = sprintf('%02d', $second);

    $array = array($name, $firstDoc, $secondDoc);
    $no_doc = implode('-', $array);

    return $no_doc;
}

function setNoTrn($date, $no_doc = null, $code)
{
    $name = "ATL-{$code}";
    $date = createDate($date)->format('dmy');

    $arrNoDoc = explode('/',  $no_doc);
    $count = (int) end($arrNoDoc) + 1;
    $no = sprintf('%02d', $count);

    $array = array($name, $date, $no);
    $no_doc = implode('-', $array);

    return $no_doc;
}
