<?php

class BusquedaCurp_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url', 'form');
        $this->load->library('form_validation');
    }

    public function curpXClave() {

        $clavecurp = rawurlencode($this->input->post('curp', TRUE));
        $aContext = array(
            'http' => array(
                'header' => "Accept-language: es-es,es;q=0.8,en-us;q=0.5,en;q=0.3\r\n" .
                "Proxy-Connection: keep-alive\r\n" .
                "Host: consultas.curp.gob.mx\r\n" .
                "User-Agent: Mozilla/5.0 (Windows; U; Windows NT 6.0; es-ES; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 (.NET CLR 3.5.30729)\r\n" .
                "Keep-Alive: 300\r\n" .
                "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8\r\n"
            //, 'proxy' => 'tcp://proxy:puerto', //Si utilizas algun proxy para salir a internet descomenta esta linea y por la direccion de tu proxy y el puerto
            //'request_fulluri' => True //Tambien esta si utilizas algun proxy
            ),
        );
        $cxContext = stream_context_create($aContext);
        $url = "http://consultas.curp.gob.mx/CurpSP/optcurp2.do;jsessionid=lB0KNYLKtWTKQJ6YlPnY8STPy5xBnY6l2bkQCCpPbkf4YbbGtGzy!-1628037550?strCurp=$clavecurp&strTipo=B";
        $file = file_get_contents($url, false, $cxContext);
        return($file);

        //  HACE LA PETICION DEL PDF A PARTIR DE LOS PARAMETROS
    }

    function busca($file) {
        $error = 0;
        $tmp = array();
        if (!$file) {
            //echo "Error, el servicio no esta disponible, intente mas tarde.";
            $error = 100;
            return $error;
        }
        preg_match_all("/homonimias /", $file, $tmp);
        $tmp = @$tmp[0][0];
        if ($tmp) {
            //echo "El servicio esta fallando, por favor intente mas tarde.";
            $error = 50;
        }
        preg_match_all("/La Fecha de Nacimiento no es/", $file, $tmp);
        $tmp = @$tmp[0][0];
        if ($tmp) {
            //echo "El servicio esta fallando, por favor intente mas tarde.";
            $error = 300;
            return $error;
        }
        preg_match_all("/Es necesario proporcionar/", $file, $tmp);
        $tmp = @$tmp[0][0];
        if ($tmp) {
            //echo "El servicio esta fallando, por favor intente mas tarde.";
            $error = 300;
            return $error;
        }
        preg_match_all("/un error/", $file, $tmp);
        $tmp = @$tmp[0][0];
        if ($tmp) {
            //echo "El servicio esta fallando, por favor intente mas tarde.";
            $error = 200;
            return $error;
        }
        preg_match_all("/no existencia/", $file, $tmp);
        $tmp = @$tmp[0][0];
        if ($tmp) {
            //echo "El registro no existe. Verifique la informacion.";
            $error = 300;
            return $error;
        }
        preg_match_all("/se encuentra /", $file, $tmp);
        $tmp = @$tmp[0][0];
        if ($tmp) {
            //echo "El registro no existe. Verifique la informacion.";
            $error = 300;
            return $error;
        }
//
        // OBTIENE LOS DATOS DESDE LA PAGINA DE LA CURP
//  $xml = "";
//  $f = fopen( 'curp1.html', 'r' );
//  while( $data = fread( $f, 4096 ) ) { $xml .= $data; }
//  fclose( $f );
        $xml = $file;

        preg_match_all("/\<input(.*?)\>/", $xml, $inputs);
        $param_post = "";
        if ($error == 50) {
            $c = 0;
            foreach ($inputs[1] as $input) {
                //echo $input."<br />";
                preg_match_all("/name=\"(.*?)\"/", $input, $name);
                preg_match_all("/value=\"(.*?)\"/", $input, $value);
                $c++;
                if ($c < 10) {
                    $param_post.=$name[1][0] . "=" . rawurlencode($value[1][0]) . "&";
                } else {
                    $param_post.=$name[1][0] . "=" . rawurlencode($value[1][0]);
                    break;
                }
            }
            $param_post = utf8_encode("50." . $param_post);
//	$param_post="homonimia";
        } else {
            $c = 0;
            foreach ($inputs[1] as $input) {
                //echo $input."<br />";
                preg_match_all("/name=\"(.*?)\"/", $input, $name);
                preg_match_all("/value=\"(.*?)\"/", $input, $value);
                $c++;
                if ($c < 33) {
                    $param_post.=$name[1][0] . "=" . rawurlencode($value[1][0]) . "&";
                } else {
                    $param_post.=$name[1][0] . "=" . rawurlencode($value[1][0]);
                    break;
                }
            }
            $param_post = utf8_encode($param_post);
        }
//$flog=fopen("log.txt","a+");
//fwrite($flog, $param_post."\n");
//fclose($flog);
        return $param_post;            // <== resultado como parametros
    }

    public function separadatos($param) {
        $curp = $this->input->post('curp');
        if (($param == 200) or ( $param == 300)) {

            // logSW('no existe curp');
            echo '<script> window.external.reproducirAudio("6"); </script>';
            echo '<div class="noDatos_" id="mostrarerrores" style="top:490px;left:300px; z-index: 1000;">';
            echo '<img src="' . base_url() . 'img/NoCurp2.png"/>';
            echo '</div>';
        } else if ($param == 100) {
            //logSW('Error servidor de registro civil para obtener la curp');
            echo '<script> window.external.reproducirAudio("6"); </script>';
            echo '<div class="noDatos_" id="mostrarerrores" style="top:490px;left:300px; z-index: 1000;">';
            echo '<img src="' . base_url() . 'img/NoCurp2.png"/>';
            echo '</div>';
            //echo '<script type="text/javascript"> window.location="frmError.php";</script> ';
        } else if ($param == 50) {
            //logSW('CURP CON HOMONIMIA');
            echo '<div class="noDatos_" id="mostrarerrores" style="top:112px;left:150px;">';
            echo '<img src="../images/homoCurp.png"/>';
            echo '</div>';
        } else {
            $urlCompleta = "http://consultas.curp.gob.mx/CurpSP/optimprimir.do?" . $param;
            //$urlCompleta="http://consultas.curp.gob.mx/CurpSP/optimprimir.do?strCurp=RAPX600923MJCMDC01&amp;strPrimerApellido=XOCHITL%20CECILIA%20ESTRELLITA%20DEL%20SUR&amp;strSegundoAplido=XOCHITL%20CECILIA%20ESTRELLITA%20DEL%20SUR&amp;strNombre=XOCHITL%20CECILIA%20ESTRELLITA%20DEL%20SUR&amp;strSexo=MUJER&amp;strFechanacimiento=23%2F09%2F1960&amp;strCveEnt=JALISCO&amp;strFolio=148900845&amp;strFechaAlta=03%2F03%2F2008&amp;strFolioDP=1&amp;strCveDP=ACTA%20DE%20NACIMIENTO&amp;strCURPDOCUMPROBACTAENTIDREGIS=06&amp;strNombreCURPDOCUMPROBACTAENTIDREGIS=COLIMA&amp;strCURPDOCUMPROBACTAMUNICREGIS=002&amp;strNombreCURPDOCUMPROBACTAMUNICREGIS=COLIMA&amp;strsCURPDOCUMPROBANIOREGISTRO=1960&amp;strCURPDOCUMPROBACTALIBRO=0001&amp;strCURPDOCUMPROBACTATOMO=%20&amp;strCURPDOCUMPROBACTAFOJA=%20&amp;strCURPDOCUMPROBNUM=01806&amp;strCURPDOCUMPROBACTACRIP=060020160018062&amp;strImpresiones=%20&amp;strRecibos=1&amp;strCveDependencia=56701060030088&amp;strDependencia=DIRECCION%20DEL%20REGISTRO%20CIVIL%20DEL%20ESTADO%20DE%20COLIMA%20%28WEB%20SERVICES%20INTERCONEXI%D3N%29&amp;depfija=04001&amp;entfija=erenapo&amp;curpsInvalidas=&amp;errores=&amp;estcurpclave=RCN&amp;session=mr79JLSdgmH7YHlKkdy3VqQcfnmN17GMwGGvTTgBsXN1kTZJS9lW%211246804630%211422398045696&amp;strNacionalidad=MEX&amp;strEntidad=JC";
            $errorUrl = "http://consultas.curp.gob.mx/CurpSP/optimprimir.do?cerrar=%20Cerrar%20Ventana%20&";
            if ($urlCompleta != $errorUrl) {
                $temp = explode("&", $param);
                $tama = count($temp);
//                echo '<script type="text/javascript">
//                $(document).ready(function(){ 
//                    $(".clase_cargando").fadeIn(200);
//                })
//                    </script>';
                echo '<link href="'.  base_url().'css/estilo.css" rel="stylesheet" type="text/css" />';
                echo '<div class="verificadatos" id="verificadatos">';
                echo '<div  class="Verificar" id="divValCurp"> ';
                echo '<img src="' . base_url() . 'img/verificar.png" id="imagenamostrar" >';
                echo '</div>';
                echo '<div id ="curpMostrar">';
                echo '<script> window.external.reproducirAudio("7"); </script>';
                echo '<div class ="csscurp">';
                for ($i = 0; $i <= 25; $i++) {
                    list($campo[$i], $valor[$i]) = explode("=", $temp[$i]);
                    // $campo[$i] = str_replace("str","", $campo[$i]);
                    $valor[$i] = str_replace("%20", " ", $valor[$i]);
                    $valor[$i] = str_replace("%2F", "/", $valor[$i]);
                    if ($campo[$i] == 'strCurp') {
                        echo '<div id="posCurp">' . $valor[$i] . '</div>';
                    }
                    if ($campo[$i] == 'strNombre') {
                        //	if 	($campo[$i]=='strPrimerApellido')	{	
                        $valor[$i] = str_replace("%D1", "Ñ", $valor[$i]);
                        $valor[$i] = str_replace("%26%2339%3B", "&#39;", $valor[$i]);
                        $contarnombre = wordwrap($valor[$i], 27, "<br />\n");
                        // if ($contarnombre > 27) {
                        // 	echo '<div id="posNommayor">'.$valor[$i].'</div>';
                        // 	//echo "Son mas de 25 =".$contarnombre;
                        // }
                        // else{
                        echo '<div id="posNom">' . $valor[$i] . '</div>';
                        //echo "Son ".$contarnombre;
                        //}
                    }
                    //if 	($campo[$i]=='strNombre')	{	
                    if ($campo[$i] == 'strPrimerApellido') {
                        $valor[$i] = str_replace("%D1", "Ñ", $valor[$i]);
                        $contarP1 = strlen($valor[$i]);
                        //if ($contarnombre>27) {
                        echo '<div id="posP1">' . $valor[$i] . '</div>';
                        //}
                        //else{
                        //echo '<div id="posP1">'.$valor[$i].'</div>';	
                        //}
                        //echo "son : ".$contarnombre;
                    }
                    if ($campo[$i] == 'strSegundoAplido') {
                        //	if 	($campo[$i]=='strNombre')	{	
                        $valor[$i] = str_replace("%D1", "Ñ", $valor[$i]);
                        echo '<div id="posP2">' . $valor[$i] . '</div>';
                    }

                    if ($campo[$i] == 'strFolio') {
                        echo '<div id="posFolio">' . $valor[$i] . '</div>';
                    }
                    if ($campo[$i] == 'strFechaAlta') {
                        echo '<div id="posFechaAlt">' . $valor[$i] . '</div>';
                    }
                    if ($campo[$i] == 'strNombreCURPDOCUMPROBACTAENTIDREGIS') {
                        echo '<div id="posEntidad">' . $valor[$i] . '</div>';
                    }
                    if ($campo[$i] == 'strNombreCURPDOCUMPROBACTAMUNICREGIS') {
                        $valor[$i] = str_replace("%D1", "Ñ", $valor[$i]);
                        // $valor[$i]= substr($valor[$i], 0,20);	
                        echo '<div id="posLocalidad">' . $valor[$i] . '</div>';
                    }
                    if ($campo[$i] == 'strsCURPDOCUMPROBANIOREGISTRO') {
                        echo '<div id="posAnioReg">' . $valor[$i] . '</div>';
                    }
                    if ($campo[$i] == 'strCURPDOCUMPROBACTALIBRO') {
                        echo '<div id="posLibro">' . $valor[$i] . '</div>';
                    }
                    if ($campo[$i] == 'strCURPDOCUMPROBACTATOMO') {
                        echo '<div id="posTomo">' . $valor[$i] . '</div>';
                    }
                    if ($campo[$i] == 'strCURPDOCUMPROBNUM') {
                        echo '<div id="posActa">' . $valor[$i] . '</div>';
                    }
                    if ($campo[$i] == 'strCURPDOCUMPROBACTAFOJA') {
                        echo '<div id="posFoja">' . $valor[$i] . '</div>';
                    }
                    if ($campo[$i] == 'strCURPDOCUMPROBACTACRIP') {
                        echo '<div id="posCrip">' . $valor[$i] . '</div>';
                    }
                }
                echo '</div>';
                echo '<form action="'.base_url().'curp/imprimir" method="get" name="dates">';
                echo '<input name="urlaprobado" type="hidden" value="'.$urlCompleta.'" >';
                echo '<input name="curp" type="hidden"  value="'.$curp.'" >';
                echo '</form>';

                //logSW('URL de la curp '.$urlCompleta);
                echo '<div id="subtitulobus">  </div> <div class="pospagar"> '
                . '<a href="javascript:enviar_formulario()" class="imprimir_reg" id="imprimir_reg" style=" border:none; background-color:transparent" onclick=\'window.external.reproducirAudio("1")\' ></a></div>';
                //. '<input name="Imprimir" type="submit" value="" align="middle" class="imprimir_reg" id="imprimir_reg" style=" border:none; background-color:transparent" onclick=\'window.external.reproducirAudio("1")\' /> </div>';
                //logSW('se mostro la CURP');
                echo '</div>';
//                echo '</div>';
//                echo '</div>';
                echo '</div>'; //fin contenedor
            }
        }
    }
}
