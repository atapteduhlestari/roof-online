<?php

use Carbon\Carbon;

function createDate($param)
{
    return Carbon::create($param);
}

function remaining($param)
{
    $dt = createDate($param);
    $now = now();
    $weekend =  $dt->dayOfWeek;
    $newDate = checkWeekend($dt, $weekend);
    $dueDate = $now->diffInDays($newDate, false);

    if ($dueDate > 30) {
        return;
    }

    $date = $now->diffInDays($newDate, false);

    if ($date < 0) {
        return "<span class='text-danger'>Out of date</span>";
    }

    return $date;

    // return date_diff($dt, $now)->format('%y years, %m months, and %d days');
}

function checkWeekend($date, $weekend)
{
    if ($weekend == '0')
        return $date->subDays(2);


    if ($weekend == '6')
        return $date->subDay(1);

    return $date;
}

function rupiah($param)
{
    $val = !$param ? null : 'Rp. ' . number_format($param);
    return $val;
}

function currency($param)
{
    $val = !$param ? null : number_format($param);
    return $val;
}

function removeDots($param)
{
    $val = !$param ? null : (float) str_replace('.', '', $param);
    return $val;
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

function setNoTrn($date, $count, $code)
{
    $name = "ATL-GAN-{$code}";
    $newDate = createDate($date)->format('my');

    if (!$count)
        return noDocIsEmpty($name, $newDate);

    return getNoDoc($count += 1, $name, $newDate);
}

function getNoDoc($count, $name, $newDate)
{
    $no = sprintf('%02d', $count);
    $array = array($name, $newDate, $no);
    $no_doc = implode('-', $array);

    return $no_doc;
}

function checkLastTrn($date, $latestDate)
{
    if ($date != $latestDate)
        return false;

    return true;
}

function noDocIsEmpty($name, $date)
{
    $array = array($name, $date, '01');
    $no_doc = implode('-', $array);

    return $no_doc;
}

function FillAlertsData($assets, $docs)
{
    $events = collect();
    foreach ($assets as $asset) {
        $events[] = [
            'name' => $asset->name,
            'date' => $asset->trn_date,
            'asset_name' => $asset->asset_name,
            'type' => 'Asset',
        ];
    }

    foreach ($docs as $doc) {
        $events[] = [
            'name' => $doc->name,
            'date' => $doc->trn_date,
            'asset_name' => $doc->doc_name,
            'type' => 'Document',
        ];
    }

    return $events;
}
