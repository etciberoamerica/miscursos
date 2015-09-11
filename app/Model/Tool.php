<?php

namespace misCursos\Model;

use Illuminate\Database\Eloquent\Model;





class Tool extends Model
{

    /*
     * Funcion que quita espacios del array a guardar
     * recive como parametros el array
     */
    public static function removeSpace(array $data){
        $data2=[];
        foreach($data as $key => $text){

            if(!is_array($text)){
                $text=trim($text);
                if($key == 'g-recaptcha-response'){
                    $key='Captcha';
                }
                $data2[$key] = $text;
            }else{
                $data2[$key] = $text;
            }

        }
        return $data2;
    }

    /*
     * Funcion de genracion de key con diferentes combinaciones
     * recibe un array con los siguiente parametros
     * MI = letras minusculas true o false
     * MA = letras mayusculas true o fale
     * NU = numeros true o false
     * CA = caracteres true o false
     * LEN=longitud
     */

    public static function generateKey(array $data){
        $texto="";
        if($data['MI']){
            $texto.='abcdefghijklmnopqrstuvwxyz';
        }
        if($data['MA']){
            $texto.='ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        }
        if($data['NU']){
            $texto.= '1234567890';
        }
        if($data['CA']){
            $texto.='|@#~$%()=^*+[]{}-_';
        }

        if($data['LEN']>0){
            $str ="";
            $texto = str_split($texto,1);
            for($i=1;$i<= $data['LEN'];$i++){
                mt_srand((double)microtime() * 100000000);
                $numero= mt_rand(1,count($texto));
                $str .= $texto[$numero - 1];
            }

        }
        return $str;

    }



}
