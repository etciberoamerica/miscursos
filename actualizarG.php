<?php
session_start();

function actualizarCiidte($idGrupo,$idProducto)
{
	$servidor="189.204.28.69";
	$base="etclearning4_db";
	$usuario="consulta";
	$password="consulta2012";
	$basemoodle="moodle_ciidte";

	$conexion=mysql_connect($servidor,$usuario,$password) or die("Error al tratar de autenticarse con el usuario de MySQL");
	mysql_select_db($base) or die("Error al tratar de conectarse con la base de datos");
	mysql_query("SET NAMES 'utf8'");
	
	$update = "UPDATE etclearning_grupos SET producto_id = $idProducto WHERE id=$idGrupo";
	$query = mysql_query($update);
		
	if($query)
	{
		return true;
	}
	else
	{
		return false;
	}
	mysql_close($conexion);
}

function 

$idGrupo=$_REQUEST['idGrupo'];
$producto=$_REQUEST['producto'];

$msconnect=mssql_connect("ServidorMSsql","admincodeETC","admincode#13*05")or die('no conecta a base de datos moac');
$update = "UPDATE sso_KeygroupCiidte SET idProduct = $producto WHERE idGrupoCiidte=$idGrupo";

$query = mssql_query($update);

if($query)
{
	$a = actualizarCiidte($idGrupo,$producto);
	
	if($a == true)
	{
		echo 'va en ciidte';
	}
	else
	{
		echo 'Error al actualizar en ciidtec';
	}
}
else
{
	echo 'Error, contacte a los administradores';
}



mssql_close();

/*
include_once('../Conexiones/conexion.php');
$e=1;
for ($a=0;$a<$e;++$a)
{
	$varR='produc'.$e;
	
	if(isset($_REQUEST[$varR]))
	{
		$idpCii=$_REQUEST[$varR];

		$numKey=1;
		while($numKey>0)
		{
			clearStoredResults($mysqli);
			$codigo=keygent();
			$buscaKeyG="call buscakeyG('".$codigo."')";
	        $queryKeyG=$mysqli->query($buscaKeyG)or die('no elecuta el procedimiento1');
	        //$numKey=mysqli_num_rows ( mysqli_result $queryKeyG);
	        $filaKG =$queryKeyG->fetch_array(MYSQLI_ASSOC);
            $numKey =$filaKG['encontro'];
            //echo"entro a while<br>";
	    }
	    clearStoredResults($mysqli);
		$creaKCii="call creaKeygruop(".$idpCii.",".$idProfCii.",".$idGrupo.",'".$Ginsti."','".$Desc."','".$codigo."','".$Gtrab."')";
        $queryKCii=$mysqli->query($creaKCii)or die('no elecuta el procedimiento2');
        if($queryKCii)
        {
        	clearStoredResults($mysqli);
            $filaKC =$queryKCii->fetch_array(MYSQLI_ASSOC);
            $idPC =$filaKC['ingreso'];
			$idKeyGroups[]=$idPC;
			$keygroupsCiidte[]=$codigo;
			$idPciidte[]=$idpCii;
			//echo"lo registtro<br>";
        }
        else
        {
        	echo"no lo registro<br>";
        }
		
		
		++$e;

	}
	else
	{
		//echo $e."no recibio la variable de producto<br>";
		break; 
	}
		
}

if(($e-1)==1)
{
	$numprodelejidos=1;
}
else
{
	$numprodelejidos=$e-1;
}




//print_r($idKeyGroups);
//consulta_productos
$cuentaArr=count($idKeyGroups);

$emailDocente=$_SESSION['maildoc'];
$idInstitucionDoc=472;
for($x=0;$x<$cuentaArr;++$x)
{

	mssql_close();
	$msconnect=mssql_connect("ServidorMSsql","moacetclatam","mo43ac34")or die('no conecta a base de datos moac'); 
	
	

	$sqlKeyGroup = "EXEC AddGruposMOAC_CIIDTEv2'".$emailDocente."','".$Ginsti."','".$Gtrab."','".$keygroupsCiidte[$x]."','".$idInstitucionDoc."','".$idPciidte[$x]."','1','';";
	echo"<br>";
	$queryKG = mssql_query($sqlKeyGroup)or die('no lo agrego a moac');
	if($queryKG)
	{	
		$codigoG=mssql_result($queryKG,0,'idG');
		//$idMoacGrupo[]=$codigoG;
		
		
		mssql_close();
		$msconnect=mssql_connect("ServidorMSsql","admincodeETC","admincode#13*05");

		if($x==0)
		{
			$idKG=1;
			if($numprodelejidos==1 && $mismokey==true)
			{
				//sel mimo key
				$newCodG=$codigo;
				$buscacodG="exec buscaKeygroupGeneral '".$newCodG."'";
				$queryBCG=mssql_query($buscacodG)or die('no lo busca en sso');
				if($queryBCG)
				{
					$idKG=mssql_result($queryBCG,0,'idK');
					if($idKG==0)
					{
						$sqlKGeneral = "EXEC GuardaKeygroups'".$newCodG."','".$Gtrab."','".$idProfCii."'";
						$queryNewKG=mssql_query($sqlKGeneral)or die('no lo guarda en sso');
						if($queryNewKG)
						{
							//echo"si lo guarda<br>";
							$idNGK=mssql_result($queryNewKG,0,'ingreso');
						}
						else
						{
							echo"no guardo key<br>";
						}
					}
				}
				else
				{
					echo"No ingreso queryBCG unico <br>";
				}
			}
			else
			{
				while($idKG>0)
				{
					$newCodG=keygent();
					$buscacodG="exec buscaKeygroupGeneral '".$newCodG."'";
					$queryBCG=mssql_query($buscacodG)or die(' no lo busca en key ');
					if($queryBCG)
					{
						$idKG=mssql_result($queryBCG,0,'idK');
						if($idKG==0)
						{
							$sqlKGeneral = "EXEC GuardaKeygroups'".$newCodG."','".$Gtrab."','".$idProfCii."'";
							$queryNewKG=mssql_query($sqlKGeneral);
							if($queryNewKG)
							{
								//echo"si lo guarda<br>";
								$idNGK=mssql_result($queryNewKG,0,'ingreso');
							}
							else
							{
								echo"no guardo key<br>";
							}
						}
					}
					else
					{
						echo"No ingreso queryBCG unico <br>";
					}
				}
			}
			
			
		} 
		mssql_close();
		$msconnect=mssql_connect("ServidorMSsql","admincodeETC","admincode#13*05");
	 	$sqlKEs = "EXEC KeygroupsEspecificos'".$idNGK."','".$idKeyGroups[$x]."','".$codigoG."','".$idPciidte[$x]."'";
	 	$queryKEs=mssql_query($sqlKEs)or die('no lo ejecuta ultimo ');
		if($queryKEs)
		{
			if($x==0)
			{
				echo"termino bien este es el keygroup general.".$newCodG."<br>";
			
				echo'<script type="text/javascript">
						location.href="Inicio.php";
					</script>';
			
			}
			
		}
		else
		{
			echo"no ejecuta el ultimo";
		}


		//codigoenciidte($codigoG,$productoCiidte,$idpc);
		
	}
	else
	{
		echo"No ingreso queryKG <br>";
	}

	

}

*/
?>
