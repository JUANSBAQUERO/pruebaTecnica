<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->css(['home']) ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <section class="content d-grid align-items-center px-3" style="height: 100vh;">
        <div class="card text-bg-secondary mb-3 shadow">
            <div class="row justify-content-center mx-0">
                <div class="col-lg-6 p-5">
                    <div class="text-center mb-4">
                        <?= $this->Html->image('logo_app.png', ['alt' => 'logo', 'class' => 'w-40']) ?>
                    </div>
                    <hr class="border-bottom border-ligth border-3">
                    <form action="">
                        <div class="mb-3">
                            <label for="correo" class="form-label">Email</label>
                            <input type="email" class="form-control" id="correo" name="c_1123" placeholder="name@example.com">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="p_1123" placeholder="******">
                        </div>
                        <div class="text-center mt-4">
                        <hr class="border-bottom border-ligth border-3">
                            <button type="submit" class="btn btn-dark">Ingresar</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6 bg-login position-relative">
                    <div class="overlay">
                        <div class="d-grid align-items-end h-100">
                            <div class="p-5">
                                <h3 class="fw-normal">Bienvenidos a</h3>
                                <h4 class="fw-light">mi plataforma.</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
