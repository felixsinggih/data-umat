<?php
function tanggal($tanggal)
{
    $bulan = array(
        1 => 'JAN',
        'FEB',
        'MAR',
        'APR',
        'MEI',
        'JUN',
        'JUL',
        'AGS',
        'SEP',
        'OKT',
        'NOV',
        'DES'
    );
    $p = explode('-', $tanggal);
    return $p[2] . ' ' . $bulan[(int)$p[1]] . ' ' . $p[0];
}

function tanggalLengkap($tanggal)
{
    $bulan = array(
        1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $p = explode('-', $tanggal);
    return $p[2] . ' ' . $bulan[(int)$p[1]] . ' ' . $p[0];
}

function datetime($tanggal)
{
    $bulan = array(
        1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $p = explode('-', $tanggal);
    $q = explode(' ', $p[2]);
    return $q[0] . ' ' . $bulan[(int)$p[1]] . ' ' . $p[0] . ' ' . $q[1];
}
