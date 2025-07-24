<?php
function liveApiUrl(){
    return 'https://ssl.du.ac.bd/api/';
}
function secretKey(){
    return '4a4cfb4a97000af785115cc9b53c313111e51d9a';
}

if (!function_exists('formatDate')) {
function formatDate($date, $format = 'd M, Y H:i A') {
        return \Carbon\Carbon::parse($date)->format($format);
    }
}

function initiatedBy()
{
    return session('user')['user_id'];
}


