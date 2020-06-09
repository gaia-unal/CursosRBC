<?php 
session_start();
if($_SESSION['autenticados'] != "si"){
        header("Location:home.php");
        exit();
} 
   
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
  <title>CVP | Mi Perfil</title>
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
                <h3>Test de Estilos de Aprendizaje</h3>
                <p>Seleccione la opción "a" o "b" para indicar su respuesta a cada pregunta. Si tanto "a" y "b" parecen aplicarse a usted, seleccione aquella que se aplique más frecuentemente. </p>

                <section id="form-test">
                <form id="forml-test" name="forml-prod" method="post" action="guardarEA.php">
                    <table width="100%">
                        <tr>
                        <td>
                        <b>1. </b>Entiendo mejor algo<br/>
                        <input type="radio" name="1" value="a" checked>  <b>a) </b>si lo practico.<br/>
                        <input type="radio" name="1" value="b" >  <b>b) </b>si pienso en ello.   
                        </td>
                        </tr>
                        <tr>
                        <td>
                        <b>2. </b>Me considero<br/>
                        <input type="radio" name="2" value="a"checked>  <b>a) </b>realista.<br/>
                        <input type="radio" name="2" value="b">  <b>b) </b>innovador.    
                        </td>
                        </tr>
                        <tr>
                        <td>
                        <b>3. </b>Cuando pienso acerca de lo que hice ayer, es más probable que lo haga sobre la base de<br/>
                        <input type="radio" name="3" value="a" checked>  <b>a) </b>una imagen.<br/>
                        <input type="radio" name="3" value="b">  <b>b) </b>palabras.   
                        </td>
                        </tr>
                        <tr>
                        <td>
                        <b>4. </b>Tengo tendencia a<br/>
                        <input type="radio" name="4" value="a" checked>  <b>a) </b>entender los detalles de un tema pero no ver claramente su estructura completa.<br/>
                        <input type="radio" name="4" value="b">  <b>b) </b>entender la estructura completa pero no ver claramente los detalles.     
                        </td>
                        </tr>
                        <tr>
                        <td>
                        <b>5. </b>Cuando estoy aprendiendo algo nuevo, me ayuda <br/>
                        <input type="radio" name="5" value="a" checked>  <b>a) </b>hablar de ello.<br/>
                        <input type="radio" name="5" value="b">  <b>b) </b>pensar en ello.     
                        </td>
                        </tr>
                        <tr>
                        <td>
                        <b>6. </b>Si yo fuera profesor, yo preferiría dar un curso<br/>
                        <input type="radio" name="6" value="a" checked>  <b>a) </b>que trate sobre hechos y situaciones reales de la vida.<br/>
                        <input type="radio" name="6" value="b">  <b>b) </b>que trate con ideas y teorías. 
                        </td>
                        </tr>
                        <tr>
                        <td>
                        <b>7. </b>Prefiero obtener información nueva de <br/>
                        <input type="radio" name="7" value="a" checked>  <b>a) </b>imágenes, diagramas, gráficas o mapas. <br/>
                        <input type="radio" name="7" value="b">  <b>b) </b>instrucciones escritas o información verbal.     
                        </td>
                        </tr>
                        <tr>
                        <td>
                        <b>8. </b>Una vez que entiendo<br/>
                        <input type="radio" name="8" value="a" checked>  <b>a) </b>todas las partes, entiendo el total.<br/>
                        <input type="radio" name="8" value="b">  <b>b) </b>el total de algo, entiendo como encajan sus partes.     
                        </td>
                        </tr>
                        <tr>
                        <td>
                        <b>9. </b>En un grupo de estudio que trabaja con un material difícil, es más probable que <br/>
                        <input type="radio" name="9" value="a"checked>  <b>a) </b>participe y contribuya con ideas.  <br/>
                        <input type="radio" name="9" value="b">  <b>b) </b> no participe y   solo escuche.      
                        </td>
                        </tr>
                        <tr>
                        <td>
                        <b>10. </b>Es más fácil para mí <br/>
                        <input type="radio" name="10" value="a" checked>  <b>a) </b> aprender hechos.  <br/>
                        <input type="radio" name="10" value="b">  <b>b) </b> aprender conceptos.      
                        </td>
                        </tr>
                        <tr>
                        <td>
                        <b>11. </b>En un libro con muchas imágenes y gráficas es más probable que <br/>
                        <input type="radio" name="11" value="a"checked>  <b>a) </b> revise cuidadosamente las imágenes y las gráficas.  <br/>
                        <input type="radio" name="11" value="b">  <b>b) </b> me concentre en el texto escrito.   
                        </td>
                        </tr>
                        <tr>
                        <td>
                        <b>12. </b>Cuando resuelvo problemas de matemáticas <br/>
                        <input type="radio" name="12" value="a" checked>  <b>a) </b>generalmente trabajo sobre las soluciones con un paso a la vez.<br/>
                        <input type="radio" name="12" value="b">  <b>b) </b>frecuentemente sé cuales son las soluciones, pero luego tengo dificultad 
	para imaginarme los pasos para llegar a ellas.
     
                        </td>
                        </tr>
                        <tr>
                        <td>
                        <b>13. </b>En las clases a las que he asistido <br/>
                        <input type="radio" name="13" value="a"checked>  <b>a) </b>he llegado a saber como son muchos de los estudiantes. <br/>
                        <input type="radio" name="13" value="b">  <b>b) </b> raramente he llegado a saber como son muchos estudiantes.     
                        </td>
                        </tr>
                        <tr>
                        <td>
                        <b>14. </b>Cuando leo temas que no son de ficción, prefiero <br/>
                        <input type="radio" name="14" value="a"checked>  <b>a) </b>algo que me enseñe nuevos hechos o me diga como hacer algo. <br/>
                        <input type="radio" name="14" value="b">  <b>b) </b> algo que me dé nuevas ideas en que pensar. 
                        </td>
                        </tr>
                        <tr>
                        <td>
                        <b>15. </b> Me gustan los maestros  <br/>
                        <input type="radio" name="15" value="a" checked>  <b>a) </b> que utilizan muchos esquemas en el pizarrón. <br/>
                        <input type="radio" name="15" value="b">  <b>b) </b> que toman mucho tiempo para explicar. 
                        </td>
                        </tr>
						<tr>
                        <td>
                        <b>16. </b>Cuando estoy analizando un cuento o una novela  <br/>
                        <input type="radio" name="16" value="a" checked>  <b>a) </b>en los incidentes y trato de acomodarlos para configurar los temas. <br/>
                        <input type="radio" name="16" value="b">  <b>b) </b>me doy cuenta de cuales son los temas cuando termino de leer y luego 
	tengo que regresar y encontrar los incidentes que los demuestran. 

                        </td>
                        </tr>
						<tr>
                        <td>
                        <b>17. </b>Cuando comienzo a resolver un problema de tarea, es más probable que  <br/>
                        <input type="radio" name="17" value="a" checked>  <b>a) </b>comience a trabajar en su solución inmediatamente. <br/>
                        <input type="radio" name="17" value="b">  <b>b) </b>primero trate de entender completamente el problema. 
                        </td>
                        </tr>
						<tr>
                        <td>
                        <b>18. </b> Prefiero la idea de <br/>
                        <input type="radio" name="18" value="a"checked>  <b>a) </b>certeza.<br/>
                        <input type="radio" name="18" value="b">  <b>b) </b>teoría. 
                        </td>
                        </tr>
						<tr>
                        <td>
                        <b>19. </b> Recuerdo mejor <br/>
                        <input type="radio" name="19" value="a"checked>  <b>a) </b>lo que veo. <br/>
                        <input type="radio" name="19" value="b">  <b>b) </b> lo que oigo. 
                        </td>
                        </tr>
						<tr>
                        <td>
                        <b>20. </b> Es más importante para mí que un profesor <br/>
                        <input type="radio" name="20" value="a"checked>  <b>a) </b>exponga el material en pasos secuenciales claros. <br/>
                        <input type="radio" name="20" value="b">  <b>b) </b> dé un panorama general y relacione el material con otros temas. 
                        </td>
                        </tr>
						<tr>
                        <td>
                        <b>21. </b>Prefiero estudiar  <br/>
                        <input type="radio" name="21" value="a"checked>  <b>a) </b>en un grupo de estudio. <br/>
                        <input type="radio" name="21" value="b">  <b>b) </b> solo.
                        </td>
                        </tr>
						<tr>
                        <td>
                        <b>22. </b> Me considero  <br/>
                        <input type="radio" name="22" value="a" checked>  <b>a) </b>cuidadoso en los detalles de mi trabajo. <br/>
                        <input type="radio" name="22" value="b">  <b>b) </b> creativo en la forma en la que hago mi trabajo. 
                        </td>
                        </tr>
						<tr>
                        <td>
                        <b>23. </b>Cuando alguien me da direcciones de nuevos lugares, prefiero  <br/>
                        <input type="radio" name="23" value="a" checked>  <b>a) </b>un mapa. <br/>
                        <input type="radio" name="23" value="b">  <b>b) </b>instrucciones escritas. 
                        </td>
                        </tr>
						<tr>
                        <td>
                        <b>24. </b>Aprendo <br/>
                        <input type="radio" name="24" value="a" checked>  <b>a) </b> a un paso constante. Si estudio con ahínco consigo lo que deseo. <br/>
                        <input type="radio" name="24" value="b">  <b>b) </b> en inicios y pausas. Me llego a confundir y súbitamente lo entiendo. 
                        </td>
                        </tr>
						<tr>
                        <td>
                        <b>25. </b> Prefiero primero  <br/>
                        <input type="radio" name="25" value="a" checked>  <b>a) </b>hacer algo y ver que sucede. <br/>
                        <input type="radio" name="25" value="b">  <b>b) </b> pensar como voy a hacer algo. 
                        </td>
                        </tr>
						<tr>
                        <td>
                        <b>26. </b>Cuando leo por diversión, me gustan los escritores que  <br/>
                        <input type="radio" name="26" value="a" checked>  <b>a) </b>dicen claramente los que desean dar a entender. <br/>
                        <input type="radio" name="26" value="b">  <b>b) </b>dicen las cosas en forma creativa e interesante. 
                        </td>
                        </tr>
						<tr>
                        <td>
                        <b>27. </b> Cuando veo un esquema o bosquejo en clase, es más probable que recuerde  <br/>
                        <input type="radio" name="27" value="a"checked>  <b>a) </b>la imagen. <br/>
                        <input type="radio" name="27" value="b">  <b>b) </b> lo que el profesor dijo acerca de ella. 
                        </td>
                        </tr>
						<tr>
                        <td>
                        <b>28. </b> Cuando me enfrento a un cuerpo de información  <br/>
                        <input type="radio" name="28" value="a" checked>  <b>a) </b>me concentro en los detalles y pierdo de vista el total de la misma. <br/>
                        <input type="radio" name="28" value="b">  <b>b) </b>)  trato de entender el todo antes de ir a los detalles. 
                        </td>
                        </tr>
						<tr>
                        <td>
                        <b>29. </b> Recuerdo más fácilmente  <br/>
                        <input type="radio" name="29" value="a" checked>  <b>a) </b>algo que he hecho. <br/>
                        <input type="radio" name="29" value="b">  <b>b) </b>algo en lo que he pensado mucho. 
                        </td>
                        </tr>
						<tr>
                        <td>
                        <b>30. </b> Cuando tengo que hacer un trabajo, prefiero <br/>
                        <input type="radio" name="30" value="a"checked>  <b>a) </b>dominar una forma de hacerlo. <br/>
                        <input type="radio" name="30" value="b">  <b>b) </b>intentar nuevas formas de hacerlo. 
                        </td>
                        </tr>
						<tr>
                        <td>
                        <b>31. </b> Cuando alguien me enseña datos, prefiero <br/>
                        <input type="radio" name="31" value="a" checked>  <b>a) </b>gráficas.<br/>
                        <input type="radio" name="31" value="b">  <b>b) </b>resúmenes con texto. 
                        </td>
                        </tr>
						<tr>
                        <td>
                        <b>32. </b> Cuando escribo un trabajo, es más probable que <br/>
                        <input type="radio" name="32" value="a" checked>  <b>a) </b>lo haga (piense o escriba) desde el principio y avance. <br/>
                        <input type="radio" name="32" value="b">  <b>b) </b> lo haga (piense o escriba)    en diferentes partes y luego las ordene. 
                        </td>
                        </tr>
						<tr>
                        <td>
                        <b>33. </b>Cuando tengo que trabajar en un proyecto de grupo, primero quiero  <br/>
                        <input type="radio" name="33" value="a" checked>  <b>a) </b>realizar una "tormenta de ideas" donde cada uno contribuye con ideas. <br/>
                        <input type="radio" name="33" value="b">  <b>b) </b>realizar la "tormenta de ideas" en forma personal y luego juntarme con el 
	grupo para comparar las ideas. 

                        </td>
                        </tr>
						<tr>
                        <td>
                        <b>34. </b> Considero que es mejor elogio llamar a alguien <br/>
                        <input type="radio" name="34" value="a" checked>  <b>a) </b>sensible. <br/>
                        <input type="radio" name="34" value="b">  <b>b) </bimaginativo. 
                        </td>
                        </tr>
						<tr>
                        <td>
                        <b>35. </b> Cuando conozco gente en una fiesta, es más probable que recuerde <br/>
                        <input type="radio" name="35" value="a" checked>  <b>a) </b>cómo es su apariencia. <br/>
                        <input type="radio" name="35" value="b">  <b>b) </b>lo que dicen de sí mismos.
                        </td>
                        </tr>
						<tr>
                        <td>
                        <b>36. </b>Cuando estoy aprendiendo un tema, prefiero<br/>
                        <input type="radio" name="36" value="a" checked>  <b>a) </b>mantenerme concentrado en ese tema, aprendiendo lo más que pueda de él.<br/>
                        <input type="radio" name="36" value="b">  <b>b) </b>hacer conexiones entre ese tema y temas relacionados. 
                        </td>
                        </tr>
						<tr>
                        <td>
                        <b>37. </b> Me considero <br/>
                        <input type="radio" name="37" value="a" checked>  <b>a) </b>abierto. <br/>
                        <input type="radio" name="37" value="b">  <b>b) </b>reservado. 
                        </td>
                        </tr>
						<tr>
                        <td>
                        <b>38. </b> Prefiero cursos que dan más importancia a <br/>
                        <input type="radio" name="38" value="a" checked>  <b>a) </b>material concreto (hechos, datos). <br/>
                        <input type="radio" name="38" value="b">  <b>b) </b>material abstracto (conceptos, teorías). 
                        </td>
                        </tr>
						<tr>
                        <td>
                        <b>39. </b> Para divertirme, prefiero  <br/>
                        <input type="radio" name="39" value="a" checked>  <b>a) </b>ver televisión. <br/>
                        <input type="radio" name="39" value="b">  <b>b) </b>leer un libro. 
                        </td>
                        </tr>
						<tr>
                        <td>
                        <b>40. </b>Algunos  profesores  inician  sus  clases  haciendo  un  bosquejo  de  lo  que enseñarán. Esos bosquejos son <br/>
                        <input type="radio" name="40" value="a" checked>  <b>a) </b>algo útiles para mí. <br/>
                        <input type="radio" name="40" value="b">  <b>b) </b> muy útiles para mí. 
                        </td>
                        </tr>
						<tr>
                        <td>
                        <b>41. </b> idea de hacer una tarea en grupo con una sola calificación para todos <br/>
                        <input type="radio" name="41" value="a" checked>  <b>a) </b>me parece bien. <br/>
                        <input type="radio" name="41" value="b">  <b>b) </b>no me parece bien. 
                        </td>
                        </tr>
						<tr>
                        <td>
                        <b>42. </b> Cuando hago grandes cálculos <br/>
                        <input type="radio" name="42" value="a" checked>  <b>a) </b>tiendo a repetir todos mis pasos y revisar cuidadosamente mi trabajo. <br/>
                        <input type="radio" name="42" value="b">  <b>b) </b>me cansa hacer su revisión y tengo que esforzarme para hacerlo. 
                        </td>
                        </tr>
						<tr>
                        <td>
                        <b>43. </b>Tiendo a recordar lugares en los que he estado  <br/>
                        <input type="radio" name="43" value="a" checked>  <b>a) </b>fácilmente y con bastante exactitud. <br/>
                        <input type="radio" name="43" value="b">  <b>b) </b>con dificultad y sin mucho detalle. 
                        </td>
                        </tr>
						<tr>
                        <td>
                        <b>44. </b>Cuando resuelvo problemas en grupo, es más probable que yo  <br/>
                        <input type="radio" name="44" value="a" checked>  <b>a) </b>piense en los pasos para la solución de los problemas. <br/>
                        <input type="radio" name="44" value="b">  <b>b) </b>piense en las posibles consecuencias o aplicaciones de la solución en un amplio rango de campos.
                        </td>
                        </tr>
						
                    </table> 
                    <br/>
                    <button type="submit" name="mostrar" id="mostrar">Finalizar Test</button>
                </form>
                </section>
             </div>  
        </section>
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
      </section>
  </section>
  <footer><p>Copyright &copy 2014 | Todos los derechos reservados</p></footer>
</body>
</html>