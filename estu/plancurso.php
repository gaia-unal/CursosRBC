<?php 
session_start();
if($_SESSION['autenticados'] != "si"){
        header("Location:home.php");
        exit();
}
 else {
     $nombre = $_SESSION['nombre'];
     $dispositivo = $_SESSION['dispositivo'];
}
   
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
  <title>CVP | Mis Cursos</title>
  <meta name="description" content="Pagina de venta de variedad de prendas de vestir" />
  <link href='http://fonts.googleapis.com/css?family=Raleway:300' rel='stylesheet' type='text/css'>
  <link type="text/css" href="../css/stylesheetHome.css"  rel="stylesheet"  />
  <link rel="shortcut icon" href="../images/demo-images/icons/favicon.ico" type="image/x-ic"/>

  <link href='http://fonts.googleapis.com/css?family=Candal' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Nunito:300' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
  
  <link href="../css/skitter.styles.css" type="text/css" media="all" rel="stylesheet" />
  <script type="text/javascript" language="javascript" src="../js/jquery-1.6.3.min.js"></script>
  <script type="text/javascript" language="javascript" src="../js/jquery.easing.1.3.js"></script>
  <script type="text/javascript" language="javascript" src="../js/jquery.animate-colors-min.js"></script>
  <script type="text/javascript" language="javascript" src="../js/jquery.skitter.min.js"></script>
   
  <script type="text/javascript" language="javascript">
    $(document).ready(function(){
      $('.box_skitter_large').skitter({label: false, numbers: false, theme: 'square'});
      $('.box_skitter_small').skitter({label: false, numbers: false, interval: 1000, theme: 'clean'});
      $('.box_skitter_medium').css({width: 500, height: 200}).skitter({show_randomly: true, dots: true, interval: 4000, numbers_align: 'center', theme: 'round'});
      $('.box_skitter_normal').css({width: 400, height: 300}).skitter({animation: 'blind', interval: 2000, hideTools: true, theme: 'minimalist'});
    });
  </script>
</head>
<body>
  <header>
    <section id="subheader">      
          <a href="../home-priv.php"><img src="../images/logo.png" alt="Litch"></img></a>
      <section id="contenedor_bot">
        <ul class="nav">
            <li><a href="../home-priv.php"><img style="width: 43px;" src="../images/icons/home.png" id="logo"/></a></li>
            <li><img src="../images/icons/settings.png"/>
                 <ul>
                    <li><a href="../logout.php">Cerrar sesi&oacuten</a></li>
                </ul>
            </li>    
            <li><label for="switch"></label></li>
        </ul>
      </section>
    </section>
  </header>

  <section id ="wrap">
      <section id="main">
        <section id="menu_nav">
              <input type="checkbox" id="switch" checked>
              <nav>
                <ul>
                  <li id="menu"><p>Men&uacute</p></li>
                  <li><a href="../estu/miperfil.php"><img src="../images/icons/perfil.png"/></a></li>
                  <li><a href="../estu/miscursos.php"><img src="../images/icons/miscursos.png"/></a></li>
                  <li><a href="../estu/mihistorial.php"> <img src="../images/icons/mihistorial.png"/></a></li>
                  <li><a href="../estu/otros.php"><img src="../images/icons/otros.png"/></a></li>
                </ul>
              </nav>
        </section>
        
        <section id="contenido">
            <div id="consulta">
               
        <?php
        //Proceso de Carga del Curso
        $curso = $_POST["curso"];
        $nombre = $_SESSION['nombre'];
        $dispositivo = $_SESSION['dispositivo'];

        $conexion = pg_connect("host='localhost' dbname='cursos_rbc' user='postgres' password='%froac$'");
        if($conexion==FALSE){
            header("Location:../error/error-conex.html");
        }
        //RECUPERAR TÍTULO DEL CURSO
        $sq = "SELECT * FROM curso WHERE id_curso='$curso'";
        $resul = pg_query($sq);
        if($resul==FALSE){
            echo "<br> Hay errores en la consulta SQL 0";
        } 
        while($ro= pg_fetch_array($resul)){
            echo"<h3>$ro[descripcion]</h3><br/>";                    
        }

        //SE CONSULTAN LOS OBJETIVOS GENERALES DEL CURSO
        $sql = "SELECT objetivoeducativo.id_oe as id_oeg, descripcionoe as descripcionoeg
                FROM cursoobjetivo, objetivoeducativo
                WHERE objetivoeducativo.id_oe = cursoobjetivo.id_oe
                AND tipooe = 'OG'
                AND id_curso = '$_POST[curso]'
                ORDER BY orden";
        $result = pg_query($sql);
        if($result==FALSE){
            echo "<br> Hay errores en la consulta SQL 1";
        } 
        //Para verificar si hay OG asociados
        if(pg_num_rows($result)> 0)
        {
            echo "<TABLE class=hovertable border=1 cellspacing=0 width=100% align=center >";
            while($row= pg_fetch_array($result)){
                //SE CONSULTAN LOS OBJETIVOS ESPECÍFICOS PERTENECIENTES A CADA OBJETIVO GENERAL
                $sql1 = "SELECT objetivoeducativo.id_oe as id_oee, descripcionoe as descripcionoee
                        FROM cursoobjetivo, objetivoeducativo
                        WHERE objetivoeducativo.id_oe = cursoobjetivo.id_oe
                        AND tipooe = 'OE'
                        AND partede = '$row[id_oeg]'
                        ORDER BY orden";
                $result1 = pg_query($sql1);
                if($result1==FALSE){
                    echo "<br> Hay errores en la consulta SQL 2";
                }
                //Imprime el OG
                echo "<TR>
                    <TH colspan='2'>$row[id_oeg]: $row[descripcionoeg]</TD>
                      </TR>";
                //Recorre todos los OE del OG seleccionado
                while($row1= pg_fetch_array($result1)){

                    //Se consulta el Historial del Estudiante, trayendo el OA asociado y verificando que 
                    //la selección del recurso se hubiera hecho para el tipo de dispositivo actual
                    
                    //Si no salen resultados quiere decir que es la pirmera vez que ingresa al curso o que 
                    //se ingresó con un dispositivo diferente
                    $sql2 = "SELECT calificacion, location, dispositivo FROM historial, caso, objetoaprendizaje
                            WHERE historial.id_caso = caso.id_caso
                            AND caso.id_oa = objetoaprendizaje.id_oa
                            AND id_estudiante = '$nombre'
                            AND id_curso = '$curso'
                            AND historial.id_oe = '$row1[id_oee]'
							AND dispositivo = '$dispositivo'";
                    $result2 = pg_query($sql2);
                    if($result2==FALSE){
                        echo "<br> Hay errores en la consulta SQL 3";
                    }
                    //Si es > 0 se encontró un contenido asociado
                    if(pg_num_rows($result2)> 0)
                    {
                        while($row2= pg_fetch_array($result2)){

                        if($row2['calificacion'] >= 70)
                        {
                            //Ya aprobó el contenido
                            echo "<TR>
                                    <TD align=center>$row1[id_oee]: $row1[descripcionoee]</TD>
                                    <TD align=center><img src='../images/icons/aprobado.jpg'/></TD>
                                  </TR>";
                        }
                        else
                        {
                            //Se verifica el dispositivo
                            //if($row2['dispositivo'] == $dispositivo)
                            //{
								echo "<TR>
                                    <TD align=center><a href='$row2[location]' target='_blank'>$row1[id_oee]: $row1[descripcionoee]</a></TD>
                                    <TD align=center><a href='../estu/evaluacion.php?id_oe=$row1[id_oee]&id_curso=$curso'><img src='../images/icons/evaluar.png'/></a></TD>
                                  </TR>";
                        }
                      }  
                    }
                    else 
                    {
                        //Aun no se han asociado OAs al usuario y se inicia el proceso de planificación
                        $oa = planificacion($nombre, $row1['id_oee'], $dispositivo, $curso);
                        echo "<TR>
                                    <TD align=center><a href='$oa' target='_blank'>$row1[id_oee]: $row1[descripcionoee]</a></TD>
                                    <TD align=center><a href='../estu/evaluacion.php?id_oe=$row1[id_oee]&id_curso=$curso'><img src='../images/icons/evaluar.png'/></a></TD>
                                  </TR>";
                    }
                }
            }
            echo "</TABLE>";
        }
        else
        {
            echo"<h2>No se cuenta con Objetivos Educativos para este curso.</h2><br/>";
        }
        @pg_close($conexion);?>      
        </div></section>
          <aside>
            <section id="registro">
                <form id="forml" name="forml" method="post" action="../registro.php">
                    <h3>Redes sociales</h3>
                    <a href=""><img src="../images/icons/facebook.png" alt="facebook"/></a>
                    <a href=""><img src="../images/icons/gmail.png" alt="gmail"/></a>
                    <a href=""><img src="../images/icons/twitter.png" alt="twitter"></a>
                </form>
            </section>
        </aside>
	</section> <!-- end contenido -->
	</section> <!-- end wrap -->
	<footer><p>Copyright &copy 2014 | Todos los derechos reservados</p></footer>
</body>
</html>

<?php

function planificacion($nombre, $id_oe, $dispositivo, $curso)
{
    //Consulto información asociada al perfil del estudiante
    $sqlestu = "SELECT * FROM estudiante WHERE id_estudiante = '$nombre'";
    $resultestu = pg_query($sqlestu);
    if($resultestu==FALSE){
        echo "<br> Hay errores en la consulta SQL estu";
    }
    if(pg_num_rows($resultestu)> 0)
    {
        while($rowestu= pg_fetch_array($resultestu)){
            $ar=$rowestu['activoreflexivo'];
            $si=$rowestu['sensorialintuitivo'];
            $vv=$rowestu['visualverbal'];
            $sg=$rowestu['secuencialglobal'];
            $idioma=$rowestu['idiomapreferencia'];
        }
    }    

    //Selección de los casos orientados al OE requerido
    $sqlc = "SELECT * FROM caso WHERE id_oe = '$id_oe' AND idioma = '$idioma'";
    $resultc = pg_query($sqlc);
    if($resultc==FALSE){
        echo "<br> Hay errores en la consulta SQL caso";
    }
    //Si se encontraron casos
    if(pg_num_rows($resultc)> 0)
    {
        $casos = array();
        $ef = array();
        while($rowc= pg_fetch_array($resultc)){
        //En esta parte se inicia el proceso puntual de RBC... seleccionando el caso similar
            $sume=0.0;
            $sume= (float) $sume + (sqrt(pow($ar - $rowc['activoreflexivo'],2)) * 22.5);
            $sume= (float) $sume + (sqrt(pow($si - $rowc['sensorialintuitivo'],2)) * 22.5);
            $sume= (float) $sume + (sqrt(pow($vv - $rowc['visualverbal'],2)) * 22.5);
            $sume= (float) $sume + (sqrt(pow($sg - $rowc['secuencialglobal'],2)) * 22.5);
            
            if($rowc['tipodispositivo']==$dispositivo)
                $sume = (float) $sume + (10*0);
            else
                $sume = (float) $sume + (10*1);
            
            $sume = (float) $sume / 100;
            
            $casos[$rowc['id_caso']] = $sume;
            $ef[$rowc['id_caso']] = $rowc['exito_fracaso'];
        }
        //Miro el el menor... y con esos datos inserto en el historial
        //Se realiza una división entre la cantidad de éxitos y la cantidad de fracasos, para seleccionar el caso que tenga un menor valor. 
        
        //Ordeno el array de menor a mayor
        asort($casos);
 
        reset($casos);
        $id_casoval = current($casos);
        $id_casosel = key($casos);
        
        $val_ef = explode("/", $ef[$id_casosel]);
        if($val_ef[0]=='0' || $val_ef[0]=='')
        {
            //echo" Se está mentiendo por este lado";
            //Se hace la asignación como si no se tuvieran casos
            return planificacion_sincasos($nombre, $id_oe, $dispositivo, $curso, $ar, $si, $vv, $sg, $idioma);
        
        }
        else 
        {
        //echo"Valor Selec: ".$id_casoval;
		//Este 6 representa el límite de la distancia entre los casos y el estudiante
        if($id_casoval <= 6)
        {
            //Selecciono la info del caso junto con la localización del OA de ese caso
            $sqltemp = "SELECT id_caso, caso.id_oe, idioma, activoreflexivo, sensorialintuitivo, visualverbal, secuencialglobal, tipodispositivo, caso.id_oa, location
                        FROM caso, objetoaprendizaje
                        WHERE caso.id_oa = objetoaprendizaje.id_oa
                        AND id_caso = '$id_casosel'";

            $resulttemp = pg_query($sqltemp);
            if($resulttemp==FALSE){
                echo "<br> Hay errores en la consulta SQL caso";
            }
            while($rowtemp= pg_fetch_array($resulttemp)){

                if(($rowtemp['activoreflexivo']==$ar)&&($rowtemp['sensorialintuitivo']==$si)&&($rowtemp['visualverbal']==$vv)&&($rowtemp['secuencialglobal']==$sg))
                {
                    //Lo agrego al historial del estudiante
                    $sqltemp4 = "INSERT INTO historial(id_estudiante, id_curso, id_oe, id_caso, dispositivo)
                                VALUES ('$nombre', '$curso', '$id_oe', '$id_casosel', '$dispositivo')";
                    $resulttemp4 = pg_query($sqltemp4);
                    if($resulttemp4==FALSE){
                        echo "<br> Hay errores en la consulta SQL historial";
                    }
                    //Retorno la localización del OA
                    return $rowtemp['location'];
                }
                else
                {
                    //Para saber cuál código poner al caso siguiente
                    $sqltemp2 = "SELECT MAX(id_caso) as num FROM caso";
                    $resulttemp2 = pg_query($sqltemp2);
                    if($resulttemp2==FALSE){
                        echo "<br> Hay errores en la consulta SQL max caso";
                    }
                    while($rowtemp2= pg_fetch_array($resulttemp2)){
                        $id_caso2 = $rowtemp2[num];
                        if($id_caso2=='')
                            $id_caso2 = 1;
                        else {
                            $id_caso2 = $id_caso2+1;
                        }
                    }

                    //Lo agrego como un caso                    
                    $sqltemp3 = "INSERT INTO caso(id_caso, id_oe, idioma, activoreflexivo, sensorialintuitivo, 
                                visualverbal, secuencialglobal, tipodispositivo, id_oa)
                                VALUES('$id_caso2', '$id_oe', '$idioma', '$ar', '$si', 
                                '$vv', '$sg', '$dispositivo', '$rowtemp[id_oa]')";
                    $resulttemp3 = pg_query($sqltemp3);
                    if($resulttemp3==FALSE){
                        echo "<br> Hay errores en la consulta SQL caso";
                    }

                    //Lo agrego al historial del estudiante
                    $sqltemp4 = "INSERT INTO historial(id_estudiante, id_curso, id_oe, id_caso, dispositivo)
                                VALUES ('$nombre', '$curso', '$id_oe', '$id_caso2', '$dispositivo')";
                    $resulttemp4 = pg_query($sqltemp4);
                    if($resulttemp4==FALSE){
                        echo "<br> Hay errores en la consulta SQL historial";
                    }
                    //Retorno la localización del OA
                    return $rowtemp[location];
                }
            }
        }
        else
        {
            //Se hace la asignación como si no se tuvieran casos
            return planificacion_sincasos($nombre, $id_oe, $dispositivo, $curso, $ar, $si, $vv, $sg, $idioma);
        }
      }
    }
    else 
    {
        //Se llama a la función que realiza el proceso cuando no hay casos
       return planificacion_sincasos($nombre, $id_oe, $dispositivo, $curso, $ar, $si, $vv, $sg, $idioma);
    }
}


function planificacion_sincasos($nombre, $id_oe, $dispositivo, $curso, $ar, $si, $vv, $sg, $idioma)
{
    //Entró por sin casos    
    //Se buscan los OAs que permitan atender ese OE específico.
        $sqloa = "SELECT * FROM objetoaprendizaje WHERE id_oe = '$id_oe' AND language = '$idioma'";
        $resultoa = pg_query($sqloa);
        if($resultoa==FALSE){
            echo "<br> Hay errores en la consulta SQL oa";
        }
        if(pg_num_rows($resultoa)> 0)
        {
            
            //Si solo hay un recurso que me permita atender ese OE
            if(pg_num_rows($resultoa)==1)
            {
                while($rowoa= pg_fetch_array($resultoa)){
                    
                    //Para saber cuál código poner al caso siguiente
                    $sqltemp = "SELECT MAX(id_caso) as num FROM caso";
                    $resulttemp = pg_query($sqltemp);
                    if($resulttemp==FALSE){
                        echo "<br> Hay errores en la consulta SQL max caso";
                    }
                  
                     while($rowtemp= pg_fetch_array($resulttemp)){
                        $id_caso = $rowtemp['num'];
                        $id_caso = $id_caso + 1;
                    }
                    
                    //Lo agrego con un caso                    
                    $sqltemp = "INSERT INTO caso(id_caso, id_oe, idioma, activoreflexivo, sensorialintuitivo, 
                                visualverbal, secuencialglobal, tipodispositivo, id_oa)
                                VALUES($id_caso, '$id_oe', '$idioma', '$ar', '$si', 
                                '$vv', '$sg', '$dispositivo', '$rowoa[id_oa]')";
                    
                    $resulttemp = pg_query($sqltemp);
                    if($resulttemp==FALSE){
                        echo "<br> Hay errores en la consulta SQL caso";
                    }
                    //Lo agrego al historial del estudiante
                    $sqltemp = "INSERT INTO historial(id_estudiante, id_curso, id_oe, id_caso, dispositivo)
                                VALUES ('$nombre', '$curso', '$id_oe', '$id_caso', '$dispositivo')";
                    $resulttemp = pg_query($sqltemp);
                    if($resulttemp==FALSE){
                        echo "<br> Hay errores en la consulta SQL historial";
                    }
                    //Retorno la localización del OA
                    return $rowoa['location'];                    
                }
            }
            else
            {
                //En este caso aplicamos las reglas necesarias para hacer la selección del OA
               //En $restuloa tenemos todos los objetos que corresponden a x OE
                $oas = array();
                $oaslocal = array();
                $sum= 0.0;
                $sumd= 0.0;
                while($rowoa= pg_fetch_array($resultoa)){
                    //Para saber cuál código poner al caso siguiente
                    $sqltipo = "SELECT * FROM tiporecursoestilo WHERE tiporecurso = '$rowoa[learningresourcetype]'";
                    $resulttipo = pg_query($sqltipo);
                    if($resulttipo==FALSE){
                        echo "<br> Hay errores en la consulta SQL tipo";
                    }
                    while($rowtipo= pg_fetch_array($resulttipo)){
                        $sum= 0.0;
                        //Para Activo/Reflexivo
                        if($ar<0)
                        {
                            $sum=$sum+($rowtipo['activo']*($ar*-1)); //Activo
                            if($rowoa['interactivitylevel']=='medium'||$rowoa['interactivitylevel']=='high'||$rowoa['interactivitylevel']=='very high')
                                $sum=$sum+($ar*-1);
                            if($rowoa['interactivitytype']=='active'||$rowoa['interactivitytype']=='mixed')
                                $sum=$sum+($ar*-1);
                        }
                        else 
                        {   
                            $sum= (float) $sum + ($rowtipo['reflexivo'] * $ar); //Reflexivo
                            if($rowoa['interactivitytype']=='expositive'||$rowoa[interactivitytype]=='mixed')
                                $sum=$sum+$ar;
                        }
                        //Para Sensorial/Intuitivo
                        if($si<0)
                            $sum=$sum+($rowtipo['sensorial']*($si*-1)); //Sensorial
                        else 
                            $sum=$sum+($rowtipo['intuitivo']*$si); //Intuitivo
                        //Para Visual/Verbal
                        if($vv<0)
                            $sum=$sum+($rowtipo['visual']*($vv*-1)); //Visual
                        else
                            $sum=$sum+($rowtipo['verbal']*$vv); //Verbal
                        //Para Secuencial/Global
                        if($sg<0)
                            $sum=$sum+($rowtipo['secuencial']*($sg*-1)); //Secuencial
                        else 
                            $sum=$sum+($rowtipo['globa']*$sg); //Global
                    }
                    
                    if($rowoa['device']==$dispositivo)
                        $sumd = 66;
                    else
                        $sumd = 0;
                    
                    $poa = (float) ($sum*0.9)+($sumd*0.1);
                    $oas[$rowoa['id_oa']] = $poa;
                    $oaslocal[$rowoa['id_oa']] = $rowoa['location'];
                    
                }
                arsort($oas);
                               
                    //Para saber cuál código poner al caso siguiente
                    $sqltemp = "SELECT MAX(id_caso) as num FROM caso";
                    $resulttemp = pg_query($sqltemp);
                    if($resulttemp==FALSE){
                        echo "<br> Hay errores en la consulta SQL max caso";
                    }
        
                    while($rowtemp= pg_fetch_array($resulttemp)){
                        $id_caso = $rowtemp['num'];
                        $id_caso = $id_caso + 1;
                    }
                    
                    reset($oas);
                    $id_oa = current($oas);
                    $id_oa = key($oas);
                    
                    //Lo agrego con un caso                    
                    $sqltemp2 = "INSERT INTO caso(id_caso, id_oe, idioma, activoreflexivo, sensorialintuitivo, 
                                visualverbal, secuencialglobal, tipodispositivo, id_oa)
                                VALUES($id_caso, '$id_oe', '$idioma', '$ar', '$si', 
                                '$vv', '$sg', '$dispositivo', '$id_oa')";
                    
                    $resulttemp2 = pg_query($sqltemp2);
                    if($resulttemp2==FALSE){
                        echo "<br> Hay errores en la consulta SQL caso pppp";
                    }
                    //Lo agrego al historial del estudiante
                    $sqltemp = "INSERT INTO historial(id_estudiante, id_curso, id_oe, id_caso, dispositivo)
                                VALUES ('$nombre', '$curso', '$id_oe', '$id_caso', '$dispositivo')";
                    $resulttemp = pg_query($sqltemp);
                    if($resulttemp==FALSE){
                        echo "<br> Hay errores en la consulta SQL historial";
                    }
                    //Retorno la localización del OA
                    return $oaslocal[$id_oa];                
            }
        }
        else 
        {
            //Quiere decir que no hay recursos disponibles para ese OE
            return "false";
        }
}
?>