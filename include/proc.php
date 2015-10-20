<?
function ValidarMunicipio($GeoCod) {
	$SemErro = FALSE;
	$Link = DBServerConnect();
	if( $Link !== FALSE ) {
		DBSelect(cDBName);
		$SQL = "SELECT * FROM Municipios WHERE Geocodigo = $GeoCod LIMIT 1;";
		$ExeSQL =  mysql_query($SQL);//  or die (mysql_error());;
		$Total = MySQLResults($ExeSQL);
		if( $Total > 0 ) {
			$SemErro = TRUE;
		}
		DBServerDisconnect($Link);				
	}
	return $SemErro;
}

function GetMun($GeoCod) {
	$Reg = array();
	$Link = DBServerConnect();
	if( $Link !== FALSE ) {
		DBSelect(cDBName);
		$SQL = "SELECT * FROM Municipios WHERE Geocodigo = $GeoCod LIMIT 1;";
		$ExeSQL =  mysql_query($SQL);//  or die (mysql_error());;
		$Total = MySQLResults($ExeSQL);
		if( $Total > 0 ) {
			$Reg = mysql_fetch_array($ExeSQL);
		}
		DBServerDisconnect($Link);				
	}
	return $Reg;
}


function Rodape(){
	Linha("<div class='prose clearfix col12 center dark'>");
	Linha(" 	<a href='http://rede.acessasp.sp.gov.br/projeto/rgm'>");
	Linha("		<img class='inline' src='http://projetorgm.com.br/imagens/creditos/rede-de-projetos.png'>");    	 
	Linha("		Uma iniciativa fundada na Rede de Projetos");
	Linha(" 	</a>");
	Linha(" 	<a class='pad1' href='https://www.mapbox.com/base'><span class='icon big mapbox'>Mapbox style</span></a>");
	Linha("</div>");
}

?>