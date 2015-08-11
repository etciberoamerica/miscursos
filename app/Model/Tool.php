<?php

namespace misCursos\Model;

use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{

    public static function removeSpace(array $data){
        $data2=[];
        foreach($data as $key => $text){
            $text=trim($text);
            if($key == 'g-recaptcha-response'){
                $key='Captcha';
            }
            $data2[$key] = $text;
        }
        return $data2;
    }
}
