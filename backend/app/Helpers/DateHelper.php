<?php

function date_idn($date)
{
    $date = \Carbon\Carbon::parse($date)
            ->locale('id')
            ->isoFormat('LL');

    return $date;
}

function date_idn2($date)
{
    $date = \Carbon\Carbon::parse($date)
            ->locale('id')
            ->isoFormat('LLLL');

    return $date;
}