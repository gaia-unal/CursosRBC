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
  <meta http-equiv="Content-type" content="text/html; charset=us-ascii" />
  <title>CVP | Home</title>
  <meta name="description" content="Plataforma para la generación de cursos virtuales personalziados" />
  <link href='http://fonts.googleapis.com/css?family=Raleway:300' rel='stylesheet' type='text/css'>
  <link type="text/css" href="css/stylesheetHome.css"  rel="stylesheet"  />
  <link rel="shortcut icon" href="images/demo-images/icons/favicon.ico" type="image/x-ic"/>

  <link href='http://fonts.googleapis.com/css?family=Candal' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Nunito:300' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
  
  <link href="css/skitter.styles.css" type="text/css" media="all" rel="stylesheet" />
  <script type="text/javascript" language="javascript" src="js/jquery-1.6.3.min.js"></script>
  <script type="text/javascript" language="javascript" src="js/jquery.easing.1.3.js"></script>
  <script type="text/javascript" language="javascript" src="js/jquery.animate-colors-min.js"></script>
  <script type="text/javascript" language="javascript" src="js/jquery.skitter.min.js"></script>
   
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
            <a href="home-adm.php"><img src="images/logo.png" alt="Litch"></img></a>
        <section id="contenedor_bot">
        <ul class="nav">
            <li><a href="home-adm.php"><img style="width: 43px;" src="images/icons/home.png" id="logo"/></a></li>
            <li><img src="images/icons/settings.png"/>
                 <ul>
                    <li><a href="logout.php">Cerrar sesi&oacuten</a></li>
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
                  <li><a href="admin/registrarCurso.php"><img src="images/icons/RegCursos.png"/></a></li>
                  <li><a href="admin/consultarcursos.php"><img src="images/icons/ConsCursos.png"/></a></li>
                  <li><a href="admin/registrarOA.php"><img src="images/icons/IngOAs.png"/></a></li>
                  <li><a href="admin/estudiantes.php"><img src="images/icons/ConsEstudiantes.png"/></a></li>
                </ul>
              </nav>
        </section>
        <section id="contenido">
            <div id="border_box">
                  <div class="box_skitter box_skitter_large">
                              <ul>
                                <li><a href="#cubeRandom"><img src="images/001.jpg" class="cubeRandom" /></a><div class="label_text"><p>cubeRandom</p></div></li>
                                <li><a href="#block"><img src="images/002.jpg" class="block" /></a><div class="label_text"><p>block</p></div></li>
                                <li><a href="#cubeStop"><img src="images/003.jpg" class="cubeStop" /></a><div class="label_text"><p>cubeStop</p></div></li>
                              </ul>
                        </div>
              </div>
        </section>
        <aside>
            <section id="registro">
                <form id="forml" name="forml" method="post" action="registro.php">
                    <h3>Redes sociales</h3>
                    <a href=""><img src="images/icons/facebook.png" alt="facebook"/></a>
                    <a href=""><img src="images/icons/gmail.png" alt="gmail"/></a>
                    <a href=""><img src="images/icons/twitter.png" alt="twitter"></a>
                </form>
            </section>
        </aside>
      </section>
  </section>
  <footer><p>Copyright &copy 2014 | Todos los derechos reservados</p></footer>
</body>
</html>