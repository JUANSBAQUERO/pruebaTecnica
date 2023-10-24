<div class="container">
    <section class="content d-grid align-items-center px-3" style="height: 100vh;">
        <div class="card text-bg-secondary mb-3 shadow">
            <div class="row justify-content-center mx-0">
                <div class="col-lg-6 p-5">
                    <div class="text-center mb-4">
                        <?= $this->Html->image('logo_app.png', ['alt' => 'logo', 'class' => 'w-40']) ?>
                    </div>
                    <hr class="border-bottom border-ligth border-3">
                    <div class="usuarios form">
                        <?= $this->Form->create() ?>
                            <fieldset>
                                <div class="mb-3">
                                    <?= $this->Form->control('usuario', [
                                        'required' => true,
                                        'class' => 'form-control',
                                        'placeholder' => 'username',
                                        'type' => 'text',
                                    ]) ?>
                                </div>
                                <div class="mb-3 position-relative">
                                    <?= $this->Form->control('password', [
                                        'required' => true,
                                        'class' => 'form-control',
                                        'placeholder' => '****',
                                        'type' => 'password',
                                        'label' => 'Contraseña',
                                        'id' => 'togglePassword'
                                    ]) ?>
                                    <a class="text-aqua toggle-password position-absolute fw-bold fs-5"><i class="bi bi-eye-slash"></i></a>
                                </div>
                            </fieldset>
                            <div class="text-center mt-4">
                            <hr class="border-bottom border-ligth border-3">
                                <?= $this->Form->submit(__('Ingresar'), ['class' => 'btn btn-dark']) ?>
                            </div>
                            <?= $this->Form->end() ?>

                            <div class="mt-3">
                                <span>¿Aun no tienes una cuenta? <?= $this->Html->link('Registrate aquí', [
                                    'controller' => 'Users', 
                                    'action' => 'registrar'],
                                    [
                                        'class' => 'text-decoration-none text-aqua'
                                    ]) ?>
                                </span>
                            </div>

                            <?php 
                                if(isset($response)):
                                    $response['status'] == 200 ? $type = 'success' : $type = 'danger';
                            ?>
                                <div class="row justify-content-center flash-toast position-absolute z-3" style="top: -6%; right: -3%">
                                        <div class="toast align-items-center text-bg-<?= $type ?> border-0 d-block mt-3" role="alert" aria-live="assertive" aria-atomic="true">
                                            <div class="toast-body text-center">
                                                <?= $response['message'] ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                    if ($response['status'] == 200):
                                ?>
                                    <script>
                                        setTimeout(() => {
                                            location.href = '/pruebaTecnica/users';
                                        }, 1000);
                                    </script>
                                <?php endif ?>
                            <?php endif ?>
                    </div>
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
</div>
<?= $this->Html->script('main')?>