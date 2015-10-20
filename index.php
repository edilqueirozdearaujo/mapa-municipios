<?
include_once "include/db.php"; 	
include_once "include/config.php"; 	
include_once "include/funcoes.php"; 	 	
include_once "include/proc.php"; 	

date_default_timezone_set('America/Sao_Paulo');

$MinhaURL 	   = "/municipios/";
$MapaURL = "http://www.projetorgm.com.br/map/";
$NotaURL = "http://www.openstreetmap.org/note/new";
$EditURL = "https://www.openstreetmap.org/login"; 


http://www.openstreetmap.org/note/new#map=12/-23.5081/-46.6205 


session_start();
if (filter_has_var(INPUT_POST,'select-municipio')) {
	$URL = "/municipios/";
	$GeoCod = filter_input(INPUT_POST,'select-municipio',FILTER_SANITIZE_STRING);
	if( ValidarMunicipio($GeoCod) ){
		$URL = $URL . "?g=$GeoCod"; 
	}
	RedirecionarPHP($URL);		
}
elseif (filter_has_var(INPUT_GET,'g')) {
	$GeoCod = filter_input(INPUT_GET,'g',FILTER_SANITIZE_STRING);
	if( ValidarMunicipio($GeoCod) ){
		$Reg = GetMun($GeoCod);
		$NomeMun = $Reg['Nome']; 
		$MapaURL = "http://www.projetorgm.com.br/map/#16/".$Reg['Lat']."/".$Reg['Lon'];
		$NotaURL = "http://www.openstreetmap.org/note/new#map=16/".$Reg['Lat']."/".$Reg['Lon'];				
		$EditURL = "http://www.openstreetmap.org/edit#map=18/".$Reg['Lat']."/".$Reg['Lon'];	
	}
}
else {
	$Municipios = "";
	$Link = DBServerConnect();
	if( $Link !== FALSE ) {		
		DBSelect(cDBName);
		$SQL = "SELECT DISTINCT Nome, Geocodigo FROM Municipios ORDER BY Nome;";
		$ExeSQL =  mysql_query($SQL);//  or die (mysql_error());;
		$Total = MySQLResults($ExeSQL);
		if( $Total > 0 ) {
			$Municipios = "<form class='fancy inline' id='form-municipio' action='/municipios/' method='post' > <span class='icon next big'> </span> Meu lugar é:  <select id='select-municipio' name='select-municipio' >";
			$Municipios = $Municipios."<option value='0' >escolha um município :)</option>";			
			for( $Cont = 0; $Cont < $Total; $Cont++ ) {
				$M = mysql_fetch_array($ExeSQL);
				$Municipios = $Municipios."<option value='".$M['Geocodigo']."' >".$M['Nome']."</option>";			
			}			  
			$Municipios = $Municipios . "</select></form>";
		}
		DBServerDisconnect($Link);				
	}
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
  <meta charset=utf-8 />
  <meta name="description" content="Mapa do lugar onde você vive - compartilhe, ajude a melhorar!">  
  <title>Municípios no mapa - SP</title>
  <link rel='shortcut icon' href='mv.ico' type='image/x-icon' />
  <link rel="shortcut icon" href="favicon.png" type="image/png"/>  
  <link href='https://www.mapbox.com/base/latest/base.css' rel='stylesheet' />
	<style>
	  body { margin:0; padding:0; }
	  #embmap { width:100%; }
	</style>
  <script src="include/jquery.min.js"></script>  
	
  
</head>
<body class="fill-navy dark">
	<div class='clearfix col12 pad0 fill-denim'>	 
		<h3 class="fancy inline"><a href="/municipios/"><span class="dark">Municípios no mapa - SP</span></a></h3>
		<? 
			$Titulo = ""; 
			if (isset($NomeMun)){echo "<h3 class='fancy inline'> <span class='icon next big'>  $NomeMun</h3>";}
			else{
				echo $Municipios;
			}
		?>			
		<div class="fr">			 
		<a class="button icon home  " href="/">Página inicial</a>
		<a class="button icon github " href="https://github.com/edilqueirozdearaujo/mapa-municipios">Fonte</a>
		</div>
	</div>	

	<div id="embmap" class='clearfix col12'>
		<iframe src="<? echo $MapaURL; ?>" width="100%" height="400px" frameborder="0"></iframe>		 
	</div>


	<div class='clearfix col12 pad1 center'>
		<a href="<? echo $MapaURL; ?>" class="button icon big plus truncate">Ampliar mapa</a>		 
		<a href="<? echo $NotaURL; ?>" class="button icon big tooltip fill-green  margin0 truncate">Falta algo no mapa? Conta pra gente :)</a>		 
		<a href="<? echo $EditURL; ?>" class="button icon big pencil fill-green  margin0 truncate">Edite e melhore este mapa :D</a>		 
	</div>

	<? Rodape(); ?>   
   <script src="include/proc.js"></script>
 
</body>
</html>