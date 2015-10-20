<?
/*
	//desabilita erros
	error_reporting(1);
	ini_set("display_errors", 1);
*/

//======================================================================================
// ================== Rotinas para páginas
//http://detectmobilebrowsers.com/
function IsMobileBrowser() {
	$useragent=$_SERVER['HTTP_USER_AGENT'];
	if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
		$Mobile = TRUE;	
	}
	else {
		$Mobile = FALSE;	
	}
	return $Mobile;
}

function DetectIEBrowser(){
    if (isset($_SERVER['HTTP_USER_AGENT']) && 
    (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false))
        return true;
    else
        return false;
}

function Linha($Conteudo) {
	echo $Conteudo . " \n";
}	

function Alertar($Mensagem) {
	echo "<script>javascript:alert('$Mensagem');</script>";
}


function Redirecionar($Link) {
		if( strtoupper($Link == "BACK")) {
			echo "<script>javascript:history.back();</script>";
		}else {
			echo "<script>javascript:window.location=\"$Link\";</script>";
		}
}

function RedirecionarPHP($Link) {
	header("Location: $Link");
}

function MostrarErro($Mensagem) {
	Linha("<div class='caixadeerro'>");
   Linha("   <p>$Mensagem</p>");	
   Linha("</div>");	
}


function MostrarErroVolta($Mensagem,$Link) {
	Linha("<div class='caixadeerro'>");
	Linha("   <p>$Mensagem</p>");	
		if( strtoupper($Link) == "BACK") {
			Linha("<p><a href='javascript:history.back();'>Clique aqui para Voltar</a></p>");
		}else {
			Linha("<p><a href='javascript:window.location=\"$Link\";'>Clique aqui para Voltar</a></p>");
		}
   Linha("</div>");	
}

function MostrarInfo($Mensagem) {
	if( $Mensagem != "" ) {
		Linha("<div  class=\"quadros-informativos\"  >");
		Linha($Mensagem);
		Linha("</div>");
	}
}


function LimparDivAnterior() {
		Linha("<div class='limpar-tudo'></div>");
}					 			

function NoIndexPHP($Str) {
	$Pos = StrPosicao('index.php',$Str);
	$Tamanho = strlen($Str);
	if( $Pos > 0 ) {
		$Resultado = StrCopy($Str,1,$Pos-1);
		if( ($Pos + 8) != $Tamanho ) {
			$Resultado = $Resultado . StrCopy($Str,($Pos + 9),$Tamanho-($Pos + 9));
		}
	}else {
	   $Resultado = $Str;
	}
	return $Resultado;
}


//================================================================================================--
//SEGURANÇA
//thanks to http://stackoverflow.com/questions/1175096/how-to-find-out-if-you-are-using-https-without-serverhttps
function IsHTTPS() {
  return
    (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
    || $_SERVER['SERVER_PORT'] == 443;
}

//redireciona para o local especificado se não for HTTPS
function RedirectIfNotIsHTTPS($OnFalse) {
  if( !IsHTTPS() ) {
    header("Location: ".$OnFalse	);
  }
}
function RedirectIfIsHTTPS($OnFalse) {
  if( IsHTTPS() ) {
    header("Location: ".$OnFalse	);
  }
}

function PageGroupAdd(&$GrupoAutorizado,$Grupo) {
	if( $GrupoAutorizado == "" ) {
		$GrupoAutorizado = $Grupo;
	}else {
		$GrupoAutorizado = $GrupoAutorizado . "," . $Grupo;
	}
}

function SecSessionStart($Nome,$WithSecure) {
	 $DeuCerto = TRUE;
	 if( !isset($Nome) ||  is_null($Nome) ) {
         $session_name = 'sec_session_id';   // Set a custom session name
	 }else{ $session_name = $Nome;  }
    $secure = $WithSecure;
    // This stops JavaScript being able to access the session id.
    $httponly = true;
    // Forces sessions to only use cookies.
    if (ini_set('session.use_only_cookies', 1) === FALSE) {
        $DeuCerto = FALSE;
    }

    if( $DeuCerto ) {
	    // Gets current cookies params.
	    $cookieParams = session_get_cookie_params();
	    session_set_cookie_params($cookieParams["lifetime"],
	        $cookieParams["path"], 
	        $cookieParams["domain"], 
	        $secure,
	        $httponly);
	    // Sets the session name to the one set above.
	    session_name($session_name);
	    session_start();            // Start the PHP session 
	    session_regenerate_id();    // regenerated the session, delete the old one. 
	 }
    return $DeuCerto;
}

function randomPassword($Tamanho) {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789!@#$%";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < $Tamanho; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}


//Gera uma senha que pelo menos tem 1 símbolo
function RandPass($Tamanho){
	$TabelaSimbolos = "!@#$%";
	do{		
	  
		//procura acento
		$Pass = randomPassword($Tamanho);
		$Encontrou = FALSE;
	    for ($Cont = 0; $Cont < 5; $Cont++) {
	    	 if( StrPosicao($TabelaSimbolos[$Cont],$Pass) > 0 ) {
				 $Encontrou = TRUE;
				 break;
		    }
	    }
	}while( !$Encontrou );
	return $Pass;
}


//======================================================================================
//MANIPULAÇÃO DE NÚMEROS 
function Impar( $num )
{
	return ( $num & 1 ) ? true : false;
}
 
function Par( $num )
{
	return ( !( $num & 1 ) );
}

function Inc(&$Num) {
	$Num = $Num + 1;
	return $Num;
}	
 
function Dec(&$Num) {
	$Num = $Num - 1;
	return $Num;
}	

function MOD($Num, $Base) {
    return $Num % $Base;
}

function DIV($Num, $Base ) {
   return floor($Num / $Base);
}


function ToBase36($Number) {
	return base_convert($Number,10,36);
}
function FromBase36($Number) {
	return base_convert($Number,36,10);
}

function RegraD3($TotalRel,$Total,$Questao) {
	if( $TotalRel === 0 ) {
     return 0;	
	}else {
     return ($Questao * $Total) / $TotalRel;
   }
}


function RegraD3Percent($TotalRel,$Questao) {
   return RegraD3($TotalRel,100,$Questao);
}



function TestarDiretorio($Caminho) {
  $SemErro = TRUE;  
  if( !file_exists($Caminho) ) {
	  	$SemErro = mkdir($Caminho, 0755,TRUE);
  }
 return $SemErro;
}


//mAnipulação de arquivos -----------------------------------------------


//http://php.net/manual/pt_BR/function.fopen.php#60718
function PHPwget($file_source, $file_target) {
	$rh = fopen($file_source, 'rb');
	$wh = fopen($file_target, 'wb');
	if ($rh===false || $wh===false) {
// error reading or opening file
	   return true;
	}
	while (!feof($rh)) {
		if (fwrite($wh, fread($rh, 1024)) === FALSE) {
			   // 'Download error: Cannot write to file ('.$file_target.')';
			   return true;
		   }
	}
	fclose($rh);
	fclose($wh);
	// No error
	return false;
}


function EscreverNoArquivo($ArquivoDest,$Conteudo) {
	fwrite($ArquivoDest,$Conteudo . " \n");
}

function ExtensaoDoArquivoSemPonto($Nome) {
	return pathinfo($Nome, PATHINFO_EXTENSION );												
} 

function ExtensaoDoArquivo($Nome) {
	return "." . ExtensaoDoArquivoSemPonto($Nome);												
} 

function NomeDoArquivo($Nome) {
	$ExtensaoArquivo = ExtensaoDoArquivo($Nome);
	return basename(pathinfo($Nome,PATHINFO_BASENAME),$ExtensaoArquivo ) ;												
} 

function FileIsImage($Extensao) {
	$Tipos = ".jpg,.png,.gif,.svg";
	if( StrPosicao($Extensao,$Tipos) > 0 ) {
		return TRUE;
	}else {
		return FALSE;
	}
}



function Vazio($Str) {
	if( is_null($Str) || $Str == ''  ) {
		return TRUE;
	}else {
		return FALSE;
	}
}


// ====================================================================================-  
//Copia caracteres de uma string igual na linguagem Pascal (Posições das Strings começam com 1)
function StrCopy($Str, $Pos, $Quant) {
	$Tamanho = strlen($Str);
	$Resultado = "";
	
	$Prosseguir = TRUE;
	if( $Pos < 1 ) {$Prosseguir = FALSE;}	
	if( $Prosseguir == TRUE){ 
		if ($Pos > $Tamanho ) {$Prosseguir = FALSE;}
	}
	if( $Prosseguir == TRUE){ 
		if ( ($Pos -1) + $Quant > $Tamanho )  {$Prosseguir = FALSE;}
	}
	
	try{
		$Resultado = substr($Str, $Pos -1, $Quant );
	}catch (Exception $e){
    	var_dump($e);
      return "";
   }
   return $Resultado;

}


//Troca um caractere e todas ocorrências do mesmo em uma string
function TrocarCaractere($S,$OldChar,$NewChar){
   return ereg_replace($OldChar, $NewChar, $S); 
}

function TirarAcento( $str ) {
return strtr(utf8_decode($str),utf8_decode('ŠŒŽšœžŸ¥µÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýÿ'),'SOZsozYYuAAAAAAACEEEEIIIIDNOOOOOOUUUUYsaaaaaaaceeeeiiiionoooooouuuuyy');
}


function TirarAcentoSimblos( $Str ) {	
	$StrTemp = TirarAcento($Str); 						//Tira acentos e caracteres especiais. Preserva espaço	
	$StrTemp = TrocarCaractere(trim($StrTemp)," ","-"); 	//Substitui espaços
	//Retira símbolos
	$StrTemp = trim(strtr(utf8_decode($StrTemp),utf8_decode("!@#$%&*()_=+/?[]{},.<>;:\|ºª"),"                            "));
	$StrTemp =  str_replace(" ","",$StrTemp); //Apaga espaços, que antes eram símbolos
	return $StrTemp; 
}



//Insere uma string dentro de outra
function StrInsert($StrAdd,$Pos,$Str) {
	$StrAntes 	= StrCopy($Str,1,$Pos-1);
	$StrDepois 	= StrCopy($Str,$Pos,(strlen($Str) - $Pos)+1);
	return $StrAntes . $StrAdd . $StrDepois;
}



function ComporLinkHTML($Link,$Titulo,$Alvo,$Texto) {
	$Resultado = "<a href='" . $Link . "' title='" . $Titulo . "'";
	if( $Alvo != "" ) {
		$Resultado = $Resultado . " target=$Alvo ";
	}
	$Resultado = $Resultado . " >$Texto</a>";
	return $Resultado;
}


//Adciona zeros à esquerda
//O número tem que ser uma string
function ZeroEsquerda($Numero,$Zeros) {
	$Produto = $Numero;
	$Tamanho = strlen($Numero);
	if( $Tamanho < $Zeros ) {
		$ZerosTemp = "";
		for( $Cont = 1; $Cont <= $Zeros - $Tamanho; $Cont++ ) {
			$ZerosTemp = $ZerosTemp . "0";
		}
		$Produto = $ZerosTemp . $Produto; 
	}

	return $Produto;
}

//Adciona zeros a direita
//O número tem que ser uma string
function ZeroDireita($Numero,$Zeros) {
    $Tamanho = strlen($Numero);
    //Verifica se tem grupos completos de 8 bits. Se não tiver, completa com zeros à DIREITA.
    if ($Tamanho > 0) {
 	    $Resto = $Zeros - $Tamanho;
 	    if( $Resto > 0 ) {
	        for ($Cont = 1; $Cont <= $Resto; $Cont++ ) {
	           $Numero = $Numero . "0";
	        }
	    }
    }
	return $Numero;
}

// ====================================================================================-  
function CharFromPos($Str, $Posicao) {
		$Resultado = $Str[$Posicao -1];
   return $Resultado;
} 

// ====================================================================================-  
//Retorna posição de uma string, igual na linguagem Pascal
function StrPosicao($SubStr,$Str) {
	$Posicao = strpos($Str,$SubStr);
	if( $Posicao === FALSE ) {
     return 0;	
	}else {
	   return $Posicao + 1;
	}
}


?>