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
                  <li><a href="registrarCurso.php"><img src="../images/icons/RegCursos.png"/></a></li>
                  <li><a href="consultarcursos.php"><img src="../images/icons/ConsCursos.png"/></a></li>
                  <li><a href="registrarOA.php"><img src="../images/icons/IngOAs.png"/></a></li>
                  <li><a href="estudiantes.php"><img src="../images/icons/ConsEstudiantes.png"/></a></li>
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
                    $sql2 = "SELECT title, location FROM objetoaprendizaje
                            WHERE objetoaprendizaje.id_oe = '$row1[id_oee]'
							";
                    $result2 = pg_query($sql2);
                    if($result2==FALSE){
                        echo "<br> Hay errores en la consulta SQL 3";
                    }
						echo "<TR>
                                    <TD align=center>$row1[id_oee]: $row1[descripcionoee]<BR/><BR/>
                                   ";
						while($row2= pg_fetch_array($result2)){
							echo "<a href='$row2[location]' TARGET='_blank'>$row2[title]</a><BR/>
                            ";
						}
						echo "</TD>
						<TD align=center><a href='../admin/evaluacionadm.php?id_oe=$row1[id_oee]&id_curso=$curso'><img src='../images/icons/evaluar.png'/></a></TD></TR>";
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
