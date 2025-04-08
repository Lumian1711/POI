<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/login.css">
    <link rel="icon" href="Imagenes/LOGO/Color-ico.ico" type="image/x-icon">
    <title>Registro</title>
</head>
<body>
    <div class="container-fluid">
        <div class="left-side">

            <img src="Imagenes/LOGO/Color-ico.ico" width="300px"> 
            <label>Chatify</label>
        </div>
        <div class="right-side">
            <div class="form-container">

                <h2>Registra tus datos</h2>
                <form method="POST" action="../PHP/registro.php">
                    <div class="mb-3">

                        <label class="form-label">Nombre de usuario</label>
                        <input id="txtUsuario" name="txtUsuario" class="form-control" type="text" required placeholder="Nombre de usuario">
                    </div>
                    <div class="mb-3">

                        <label class="form-label">Correo</label>
                        <input id="txtCorreo" name="txtCorreo" class="form-control" type="email" required placeholder="@email.com">
                    </div>
                    <div class="mb-3">

                        <label class="form-label">Contraseña</label>
                        <input id="txtPassword" name="txtPassword" class="form-control" type="password" required placeholder="Contraseña">
                    </div>
                    <div class="d-grid">

                        <button id="btnLogin" type="submit" class="btn btn-primary">Registrar</button>
                    </div>
                </form>
                <div class="mt-3">

                    <p>¿Ya tienes una cuenta? <a href="login.php">Inicia sesión</a></p>
                </div>

            </div>
        </div>
    </div>
</body>

<script src="JS/bootstrap.min.js"></script>
</html>