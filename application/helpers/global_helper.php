<?php

function calculate_rank($rank_values)
{
    arsort($rank_values);
    $rank_array = [];
    $rank = 0;
    $r_last = null;
    foreach ($rank_values as $key => $value) {
        if ($value != $r_last) {
            if ($value > 0) { //if you want to set zero rank for values zero
                $rank++;
            }
            $r_last = $value;
        }

        $rank_array[$key] = $value > 0 ? $rank : 0; //if you want to set zero rank for values zero
    }
    // echo '<pre>';
    // echo print_r($rank_array);
    // echo '</pre>';
    return $rank_array;
}

function TanggalIndo($t = '', $j = '')
{

    $tgl_indo = '-';
    if ($t != '' and $t != '0000-00-00') {

        $th = substr($t, 0, 4);
        $bl = substr($t, 5, 2);
        switch ($bl) {
            case '1':
                $nb  = 'Januari';
                $nb2 = 'Jan';
                break;
            case '2':
                $nb  = 'Februari';
                $nb2 = 'Feb';
                break;
            case '3':
                $nb  = 'Maret';
                $nb2 = 'Mar';
                break;
            case '4':
                $nb  = 'April';
                $nb2 = 'Apr';
                break;
            case '5':
                $nb  = 'Mei';
                $nb2 = 'Mei';
                break;
            case '6':
                $nb  = 'Juni';
                $nb2 = 'Jun';
                break;
            case '7':
                $nb  = 'Juli';
                $nb2 = 'Jul';
                break;
            case '8':
                $nb  = 'Agustus';
                $nb2 = 'Agus';
                break;
            case '9':
                $nb  = 'September';
                $nb2 = 'Sept';
                break;
            case '10':
                $nb  = 'Oktober';
                $nb2 = 'Okt';
                break;
            case '11':
                $nb  = 'November';
                $nb2 = 'Nov';
                break;
            case '12':
                $nb  = 'Desember';
                $nb2 = 'Des';
                break;
            default:
                $nb  = '-';
                $nb2 = '-';
                break;
        }
        $tgl      = substr($t, 8, 2);
        $jam      = substr($t, 11, 8);
        $tgl_indo = $tgl . ' ' . $nb . ' ' . $th . ' ' . $jam;
        if ($j != '') {
            $tgl_indo = $tgl . ' ' . $nb2 . ' ' . $th . ' ' . $jam;
        }
    }

    return $tgl_indo;
}