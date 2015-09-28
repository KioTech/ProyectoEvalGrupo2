<!--a href="mat/index.php" onclick="window.external.reproducirAudio('1')" id="mat"></a-->

<script type="text/javascript">
  function timbre(dato){
     try {        
        window.external.reproducirAudio('1');
		    window.external.ServicioActivoWebAnt(dato); //ser
    }catch(err) {
        console.log(err.message);
    } 
  }	
  </script>

<ul class="btns-servicios">
	<li class="pull-left"><a href="matrimonio" id="MAT" onclick="timbre('ACTAS DE MATRIMONIO')"></a></li>
	<li class="pull-right"><a href="curp" id="CURP" onclick="timbre('CURP')"></a></li>
	<li class="pull-left"><a href="nacimiento" id="NAC" onclick="timbre('ACTAS DE NACIMIENTO')"></a></li>
	<li class="pull-right"><a href="defuncion" id="DEF" onclick="timbre('ACTAS DE DEFUNCION')" ></a></li>
</ul>
  <!-- <a href="nac/frmBuscarNom.php" onclick="validarfolios();" id="nac"></a>
  <a href="curp/index.php" onclick="validarfolios2();" id="curp"></a> -->
<a onclick="window.external.regresarInicio()" id="regresar/>

 