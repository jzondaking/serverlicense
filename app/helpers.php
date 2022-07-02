<?php 

function durationFormat($seconds) 
{
    if ($seconds < 60) {
        
        return strval($seconds)." giây";
        
    } else if($seconds >= 60 && $seconds < 3600) {
        
        return strval(round($seconds / 60))." phút";
        
    } else if($seconds >= 3600 && $seconds < 86400) {
        
        return strval(round($seconds / 3600))." giờ";
        
    } else if($seconds >= 86400 && $seconds < 604800) {
        
        return strval(round($seconds / 86400))." ngày";
        
    } else if($seconds >= 604800 && $seconds < 2630000) {
        
        return strval(round($seconds / 604800))." tuần";
        
    } else if($seconds >= 2630000 && $seconds < 31557600) {
        
        return strval(round($seconds / 2630000))." tháng";
        
    } else {
        
        return strval(round($seconds / 31557600))." năm";
        
    }
}

function convertDurationSeconds($seconds)
{
    if ($seconds < 60) {
        
        return $seconds;
        
    } else if($seconds >= 60 && $seconds < 3600) {
        
        return round($seconds / 60);
        
    } else if($seconds >= 3600 && $seconds < 86400) {
        
        return round($seconds / 3600);
        
    } else if($seconds >= 86400 && $seconds < 604800) {
        
        return round($seconds / 86400);
        
    } else if($seconds >= 604800 && $seconds < 2630000) {
        
        return round($seconds / 604800);
        
    } else if($seconds >= 2630000 && $seconds < 31557600) {
        
        return round($seconds / 2630000);
        
    } else {
        
        return round($seconds / 31557600);
        
    }
}

function periodDetection($seconds)
{
    if ($seconds < 60) {
        
        return 'seconds';
        
    } else if ($seconds >= 60 && $seconds < 3600) {
        
        return 'minutes';
        
    } else if($seconds >= 3600 && $seconds < 86400) {
        
        return 'hours';
        
    } else if($seconds >= 86400 && $seconds < 604800) {
        
        return 'days';
        
    } else if($seconds >= 604800 && $seconds < 2630000) {
        
        return 'weeks';
        
    } else if($seconds >= 2630000 && $seconds < 31557600) {
        
        return 'months';
        
    } else {
        
        return 'years';
        
    }
}

function update_env( $data = [] ) : void {  

    $path = base_path('.env');

    if (file_exists($path)) {
        foreach ($data as $key => $value) {
            file_put_contents($path, str_replace(
                $key . '=' . env($key), $key . '=' . $value, file_get_contents($path)
            ));
        }
    }

}