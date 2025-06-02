<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/login.css">
    <link rel="icon" href="Imagenes/LOGO/Color-ico.ico" type="image/x-icon">
    <title>Inicio de sesión</title>
</head>
<body>
    <div class="container-fluid">
        <div class="left-side">
            <img src="Imagenes/LOGO/Color-ico.ico" width="300px"> 
            <label>Chatify</label>
        </div>
        <div class="right-side">
            <div class="form-container">
                <h2>Iniciar Sesión</h2>
                <form method="POST" action="PHP/login.php">
                    <div class="mb-3">

                        <label class="form-label">Correo</label>
                        <input id="txtUsuario" name="txtUsuario" class="form-control" type="text" required placeholder="Correo electrónico">
                    </div>
                    <div class="mb-3">

                        <label class="form-label">Contraseña</label>
                        <input id="txtPassword" name="txtPassword" class="form-control" type="password" required placeholder="Contraseña">
                    </div>
                    <div class="d-grid">

                        <button type="submit" id="btnLogin" class="btn">Iniciar sesión</button>
                    </div>
                    <div class="mt-3">

                        <p>¿No tienes una cuenta? <a href="registro.php"> Regístrate</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="/JS/bootstrap.min.js"></script>

</html>