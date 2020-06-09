<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Catel&uacute | Inicio</title>
    <link rel="stylesheet" type="text/css" href="css/stylesheeterror1.css">
    <link rel="shortcut icon" href="images/demo-images/icons/favicon.ico" type="image/x-ic"/>
    
    <link href='http://fonts.googleapis.com/css?family=Raleway:300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Berkshire+Swash' rel='stylesheet' type='text/css'>
</head>
<body>
	<header>
    	<div id="subheader">
            <div id="logo">
            	<a href="#"><img src="images/demo-images/logo1.png" width="90%" height="96"/></a>
            </div>
    
            <div id="formulario">
                <form id="forml" name="forml" method="post" action="prehome.php">
                    <h3>Inicie sesión</h3>
                    <input type="text" name="nombre" autofocus required="required" placeholder="  Ingrese su nombre" autocomplete="on"/>
                    <input type="password" name="password" autofocus required="required" placeholder="  Ingrese su contraseña"/>
                    <button type="submit" name="iniciar" >Iniciar</button>
                    <p>Usuario y/o contraseña inconrectos.</p>
                </form>
            </div>
         </div>
	</header>

	<section id="wrap">
    	
            <section id="contenido">
                <h3>Ingresa a nuestra pagina</h3>
                <!--- el siguiente href va a nuevo html para no registrados -->
                <a href="home.php"><img src="images/demo-images/thumb1.jpg"></img></a>
            </section>
                
            <section id="registro">
                <form id="forml" name="forml" method="post" action="registro.php">
                    <h3>Regístrate</h3><br>
                    	<div class="input">
                            <input type="text" name="nombre" id="nombre"required placeholder="  Nombre de Usuario" autocomplete="on" maxlength="20">
                            <input type="text" name="cedula" id="cedula" required placeholder="  C.c" autocomplete="on" maxlength="15">
                            <input type="text" name="numero" id="numero"required placeholder="  Número tel" autocomplete="on" maxlength="15">
                            <input type="email" name="email" id="email" required placeholder="  Tu correo electronico" autocomplete="on" maxlength="40"/>
                            <input type="password" name="password" id="password" required placeholder="  Contraseña" autocomplete="on" maxlength="40"/>
                            <input type="password" name="repassword" id="repassword" required placeholder="  Confirma tu contraseña" maxlength="20">
                         </div>
                    <br>
                    <p>Al hacer clic en Regístrate, aceptas las Condiciones y que has leído la Política de uso de datos, incluido el Uso de cookies.</p>
                    <br>
                    <button type="submit" name="registrar" id="registrar">Crear cuenta</button>
                </form>
            </section>
            
    </section>

	 <div id="copyright"><p>Copyright © DanielLlanoB | Bases de datos II 2014</p></div>
     
     <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
	 <script src="js/jquery.rotate.js"></script>
     <script src="js/script.js"></script>

</body>
</html>