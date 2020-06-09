<?php 
session_start();

  if ($_SESSION['NombreAutenticado'] != "admin"){
    if ($_SESSION['autenticados'] != "si"){
      header("Location:home.php");
      exit();
    }
  }

 ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
  <title>CVP | Registrar OA</title>
  <meta name="description" content="Plataforma para la generación de cursos virtuales personalziados" />
  <link href='http://fonts.googleapis.com/css?family=Raleway:300' rel='stylesheet' type='text/css'>
  <link type="text/css" href="../css/stylesheetHome.css"  rel="stylesheet"  />
  <link rel="shortcut icon" href="../images/icons/favicon.ico" type="image/x-ic"/>

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
            <a href="../home-adm.php"><img src="../images/logo.png" alt="Litch"></img></a>
        <section id="contenedor_bot">
        <ul class="nav">
            <li><a href="../home-adm.php"><img style="width: 43px;" src="../images/icons/home.png" id="logo"/></a></li>
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
                  <li><a href="estudiantes.php"><img src="../images/icons/ConsEstudiantes.png"/></a></
                </ul>
              </nav>
        </section>
        <section id="contenido">
            <div id="consulta">
                <h3>Registrar OA</h3><br/>
                <section id="form-producto">
                <form id="forml-prod" name="forml-prod" method="post" action="guardarOA.php">
                    <table width="100%">
                        <tr>
                        <td>
                        <b>Título:</b>
                        </td>
                        <td>
                            <input id="title" name="title" type="text" size="60" required="required" />
                        </td>
                        </tr>
                        <tr>
                        <td>
                        <b>Idioma:</b>
                        </td>
                        <td>
                            <select id=language name=language required="required">
                                <option value= >-- Seleccione -- </option>
                                <option value='sp'> Español </option>
                                <option value='pt'> Portugués </option>
                                <option value='en'> Inglés </option>
                            </select>
                        </td>
                        </tr>
                        <tr>
                        <td>
                        <b>Dispositivo:</b>
                        </td>
                        <td>
                            <select id=device name=device required=required>
                                <option value= >-- Seleccione -- </option>
                                <option value='t'> Tablet </option>
                                <option value='pc'> Computador </option>
                                <option value='c'> Celular </option>
                            </select>
                        </td>
                        </tr>
                        <tr>
                        <td>
                        <b>Tipo de Recurso Educativo:</b>
                        </td>
                        <td>
                            <select id=learningresourcetype name=learningresourcetype required=required>
                                <option value= >-- Seleccione -- </option>
                                <option value='lecture'> Lectura </option>
                                <option value='self assessment'> Autoevaluación </option>
                                <option value='problem statement'> Declaración de Problema </option>
                                <option value='exercise'> Ejercicio </option>
                                <option value='experiment'> Experimento </option>
                                <option value='exam'> Examen </option>
                                <option value='table'> Tabla </option>
                                <option value='narrative text'> Texto Narrativo </option>
                                <option value='slide'> Presentación </option>
                                <option value='graph'> Gráfico </option>
                                <option value='figure'> Figura </option>
                                <option value='diagram'> Diagrama </option>
                                <option value='questionnaire'> Cuestionario </option>
                                <option value='simulation'> Simulación </option>
                           </select>
                        </td>
                        </tr>
                        <tr>
                        <td>
                        <b>Nivel de Interactividad:</b>
                        </td>
                        <td>
                            <select id=interactivitylevel name=interactivitylevel required=required>
                                <option value= >-- Seleccione -- </option>
                                <option value='very low'> Muy bajo </option>
                                <option value='low'> Bajo </option>
                                <option value='medium'> Medio </option>
                                <option value='high'> Alto </option>
                                <option value='very high'> Muy alto </option>
                           </select>
                        </td>
                        </tr>
                        <tr>
                        <td>
                        <b>Tipo de Interactividad:</b>
                        </td>
                        <td>
                            <select id=interactivitytype name=interactivitytype required=required>
                                <option value= >-- Seleccione -- </option>
                                <option value='active'> Activo </option>
                                <option value='expositive'> Expositivo </option>
                                <option value='mixed'> Mixto </option>
                           </select>
                        </tr>
                        <tr>
                        <td>
                        <b>Localización:</b>
                        </td>
                        <td>
                            <input id="location" name="location" type="text" size="60" required=required/>
                        </td>
                        </tr>
                      
                        <tr>
                        <td>
                        <b>Objetivo Educativo:</b>
                        </td>
                        <td>
                            <?php 
                            $conexion = pg_connect("host='localhost' dbname='cursos_rbc' user='postgres' password='%froac$'");
                            if($conexion==FALSE){
                                header("Location:../error/error-conex.html");
                            }
                            $sql = "SELECT * FROM objetivoeducativo WHERE tipooe = 'OE'";
                            $result = pg_query($sql);
                            if($result==FALSE){
                                    echo "<br> Hay errores en la consulta SQL";
                            } 
                            echo "<select id=selectoe name=selectoe  style=width:95% required=required>
                                    <option value=>-- Seleccione -- </OPTION>";

                            while($row= pg_fetch_array($result))	{
                                echo "<OPTION value=$row[id_oe]>$row[id_oe]: $row[descripcionoe]</option>";
                            }
                            echo "</select>";
                            @pg_close($conexion);?>
                        </td>
                        </tr>
                    </table>
                <BR/>
                <button type="submit" name="mostrar" id="mostrar">Guardar OA</button>
                </form>
                </section>
             </div>
        </section>
        <aside>
            <section id="registro">
                <form id="forml" name="forml" method="post" action="registro.php.php">
                    <h3>Redes sociales</h3>
                    <a href=""><img src="../images/icons/facebook.png" alt="facebook"/></a>
                    <a href=""><img src="../images/icons/gmail.png" alt="gmail"/></a>
                    <a href=""><img src="../images/icons/twitter.png" alt="twitter"></a>
                </form>
            </section>
        </aside>
      </section>
  </section>
  <footer><p>Copyright &copy 2014 | Todos los derechos reservados</p></footer>
</body>
</html>