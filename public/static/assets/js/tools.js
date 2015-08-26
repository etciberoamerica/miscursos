/**
 * Created by ust.mxl14qy on 26/08/2015.
 */




function removeSpaceArray(data){
    var datar = [];
    $.each(data, function ($i,$value){
        datar.push({
            'name'  : $value.name,
            'value' : $value.value.trim()
        });
    });
return datar
}


function checkVacu(val,name){
    var msj = "";
    if(val == ""){
        msj +="El campo "+name.toLowerCase()+ " es requerido.";
    }

        return msj;
}


function matchCadena(val,name){

    var msj = "";
  if(val != ''){
       if(!val.match(/^[0-9]+$/)){
            if(!val.match(/^[0-9a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ_\s]+$/)){
                msj +="El campo "+name.toLowerCase()+ " solo debe contener letras, números y guiones.";
            }
        }

    }

    return msj;
}
