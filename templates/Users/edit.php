
<?= $this->element('header') ?>

<section class="content d-grid align-items-center px-3" style="height: 100vh;">
    <div class="container">
        <div class="card text-bg-secondary mb-3 shadow p-5">
            <div class="users index content">
                <div class="position-relative d-flex justify-content-between">
                    <div>
                        <h3><?= __('Editar usuario') ?></h3>
                        <p>Aquí podra editar el selecciona usuario en la plataforma.</p>
                    </div>
                    <div>
                        <?= $this->Html->Link(__('Lista de usuarios'), ['action' => 'index'], ['class' => 'btn bg-aqua']) ?>
                    </div>
                </div>
                <hr class="border-bottom border-ligth border-3">
                <div class="row justify-content-center">
                    <div class="users form content">
                        <?= $this->Form->create($user) ?>
                        <fieldset>
                            <div class="row justify-content-center">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <?= $this->Form->control('nombres', [
                                            'required' => true,
                                            'class' => 'form-control',
                                            'placeholder' => 'Ingrese sus nombres',
                                            'type' => 'text',
                                        ]) ?>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <?= $this->Form->control('apellidos', [
                                            'required' => true,
                                            'class' => 'form-control',
                                            'placeholder' => 'Ingrese sus apellidos',
                                            'type' => 'text',
                                        ]) ?>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <?= $this->Form->control('usuario', [
                                            'required' => true,
                                            'class' => 'form-control',
                                            'placeholder' => 'Ingrese su nombre de usuario',
                                            'type' => 'text',
                                        ]) ?>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <?= $this->Form->control('correo', [
                                            'required' => true,
                                            'class' => 'form-control',
                                            'placeholder' => 'name@example.com',
                                            'type' => 'email',
                                            'label' => 'Email'
                                        ]) ?>
                                    </div>
                                </div>
                                <div class="col align-items-end d-grid">
                                    <div class="mb-3 text-center">
                                        <?= $this->Form->control('estado', [
                                            'required' => false,
                                            'class' => 'form-check-input',
                                            'type' => 'checkbox',
                                            'label' => ' Estado'
                                        ]) ?>
                                    </div>
                                </div>
                                <div class="col align-items-end d-grid">
                                    <div class="mb-3">
                                        <?= $this->Form->button(__('Editar usuario'), ['class' => 'btn btn-dark']) ?>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
