<?php
function atlSong()
{
    $lyrics = "(*) MENTARI YANG PANAS <br>
    ATAU HUJAN DERAS<br>
    TAK KAN MEMBUAT AKU MALAS<br>
    <br>
    KU TETAP BERGEGAS<br>
    MENJALANKAN TUGAS<br>
    DEMI KELUARGA DAN JUGA CITA CITA KU<br>
    UUU.....<br>
    AAA......<br>
    ATAP MENEDUHI KEHIDUPANKU<br>
    ATAP PUN MEMBANTU MEWUJUDKAN MIMPI KU<br>
    KU KAN BERJUANG<br>
    RAIH PELUANG<br>
    PELANGGAN YG DATANG KAN KEUNTUNGAN<br>
    KAN KU TERANGKAN<br>
    SEPENUH HATI<br>
    HANYA DISINI PRODUK YG TERBAIK<br>
    <br>
    DI ATAP TEDUH LESTARI --> (*)<br>
    <br>
    Atap Teduh Lestari,<br><i>every product is beautiful
    customer feels good, great satisfaction<br>
    back home winning story, morning glory<br>
    <br></i>
    KU KAN BERJUANG<br>
    RAIH PELUANG<br>
    PELANGGAN YG DATANG KAN KEUNTUNGAN<br>
    <br>````````
    KAN KU TERANGKAN<br>
    SEPENUH HATI<br>
    HANYA DISINI PRODUK YG TERBAIK";

    return $lyrics;
}

function removeSpecialChar($str)
{
    $param = trim($str);

    $res = str_replace(array(
        '\'', '"', ',', ';', '<', '>', '!', '#', '$', '*', '%', '@'
    ), '', $param);

    return $res;
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
