<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('css/style.css'); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <title>Login</title>
</head>

<body>
    <section class="side">
        <img src="<?= base_url('img/edificio.png'); ?>" alt="">
    </section>

    <section class="main">
        <div class="login-container">
            <p class="title">LOGIN REPOSITORIO</p>
            <div class="separator"></div>

            <form class="login-form" action="<?= base_url('dashboard'); ?>">
                <div class="form-control">
                    <input type="text" placeholder="Usuario">
                    <i class="fas fa-user"></i>
                </div>
                <div class="form-control">
                    <input type="password" placeholder="Contraseña">
                    <i class="fas fa-lock"></i>
                </div>

                <button class="submit">Iniciar Sesion</button>
            </form>
        </div>
    </section>

</body>

</html>