<?php

use Carbon\Carbon;
use App\Models\SBU;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;


function getImage($fileName)
{
    $path = storage_path('app/public/') . $fileName;

    if (!File::exists($path)) {
        abort(404); // return 404 page
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = response()->make($file, 200);
    $response->header("Content-Type", $type);

    return $path;
}

function detect()
{
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    if (preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i', $userAgent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($userAgent, 0, 4)))
        return true;
}

function formatTimeDoc($param, $extension)
{
    $name = Str::slug($param);
    return $name . '_' . now()->format('d-m-Y_h-i-s') . '.' . $extension;
}

function createDate($param)
{
    return $param ? Carbon::create($param) : '';
}

function diffForHuman($param)
{
    return $param ? Carbon::parse($param)->diffForHumans() : '';
}

function textCondition($param)
{
    if ($param == 1)
        return 'Excellent';
    if ($param == 2)
        return 'Fair';
    if ($param == 3)
        return 'Poor';
    if ($param == 4)
        return 'Disposed';
}

function colorCondition($param)
{
    if ($param == 1)
        return 'text-success';
    if ($param == 2)
        return 'text-warning';
    if ($param == 3)
        return 'text-danger';
    if ($param == 4)
        return 'font-weight-bold font-italic text-grey';
}

function remaining($param)
{
    $dt = createDate($param);
    $now = now();
    $day =  $dt->dayOfWeek;
    $newDate = checkWeekend($dt, $day);
    $dueDate = $now->diffInDays($newDate, false);

    if ($dueDate > 30) {
        return;
    }

    if ($dueDate < 0) {
        return "<span class='text-danger'>Out of date</span>";
    }

    return $dueDate += 1;

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

function getPeriodeExport($data)
{
    $start = null;
    $startYear = null;
    $end = null;
    $endYear = null;

    if ($data['start']) {
        $start = createDate($data['start'])->format('F');
        $startYear = createDate($data['start'])->format('Y');
    }

    if ($data['end']) {
        $end = createDate($data['end'])->format('F');
        $endYear = createDate($data['end'])->format('Y');
    }

    $sd = 'sd';

    if ($start ==  $end && $startYear == $endYear) {
        $end = null;
        $endYear = null;
        $sd = null;
    }

    if ($startYear == $endYear) {
        $startYear = null;
    }

    $text = "$start $startYear $sd $end $endYear";
    $periode = trim($text) == '' ? 'All' : $text;

    return $periode;
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
    $data = collect();
    foreach ($assets as $asset) {
        $events[] = [
            'name' => $asset->name,
            'date' => $asset->trn_start_date,
            'asset_name' => $asset->asset_name,
            // 'sbu_name' => $asset->sbu->sbu_name,
            'type' => 'Asset',
            'link' => "/trn-maintenance/{$asset->trn_id}"
        ];
    }

    foreach ($docs as $doc) {
        $events[] = [
            'name' => $doc->name,
            'date' => $doc->trn_start_date,
            'asset_name' => $doc->doc_name,
            // 'sbu_name' => $doc->sbu->sbu_name,
            'type' => 'Document',
            'link' => "/trn-renewal/{$doc->trn_id}"
        ];
    }

    $count = $events->count();
    $data['count'] = $count;
    $data['events'] = ($events->sortBy('date')->take(3));

    return $data;
}

function timelineReminders($assets, $docs)
{
    $data = collect();

    foreach ($assets as $asset) {
        $data->push([
            'id' => $asset->trn_id,
            'name' => $asset->name,
            'date' => $asset->trn_start_date,
            'asset_name' => $asset->asset_name,
            'sbu_name' => $asset->sbu_name,
            'type' => 'Asset',
        ]);
    }

    foreach ($docs as $doc) {
        $data->push([
            'id' => $doc->trn_id,
            'name' => $doc->name,
            'date' => $doc->trn_start_date,
            'asset_name' => $doc->doc_name,
            'sbu_name' => $doc->sbu_name,
            'type' => 'Document',
        ]);
    }

    return $data;
}

function isSuperadmin()
{
    return auth()->user()->is_admin == 1;
}

function isUserSBU()
{
    return auth()->user()->is_admin == 2;
}

function checkUser()
{
    return auth()->user()->is_admin;
}

function userSBU()
{
    return auth()->user()->sbu_id;
}

function findSBU($id)
{
    $sbu = SBU::find($id);
    return $sbu ? $sbu->sbu_name : '';
}

function getFileName($param)
{
    if ($param) {
        $fileName =  explode('/',  $param);
        return $fileName[4];
    }

    return 'none';
}
