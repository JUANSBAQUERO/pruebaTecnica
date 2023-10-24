<?= $this->element('header') ?>
<?php
    $perfilUsuario = $this->getRequest()->getSession()->read('Auth.User.perfil');
?>

<section class="content d-flex align-items-center px-3" style="height: 100vh;">
    <div class="container mt-5">
        <div class="card text-bg-secondary mb-3 shadow p-5">
            <div class="users index content">
            <div class="position-relative d-flex justify-content-between">
                <div>
                    <h3><?= __('Usuarios') ?></h3> 
                    <p>Aquí encontrara toda la información de los usuarios creados actualmente en la plataforma.</p>
                </div>
                <div>
                    <?= $this->Html->Link(__('Crear Usuario'), ['action' => 'add'], ['class' => 'btn bg-aqua']) ?>
                </div>
            </div>
            <hr class="border-bottom border-ligth border-3">
            <h6>Filtrar por fecha</h6>
            <div class="d-flex mb-3">
                <input class="form-control mr-3" type="date" id="start-date">
                <input class="form-control mx-3" type="date" id="end-date">
                <button class="btn btn-secondary bg-aqua" id="search-button">Buscar</button>
            </div>
                <div class="table-responsive">
                    <table
                        class="table table-bordered text-nowrap w-100 key-buttons"
                        id="table"
                    >
                        <thead>
                            <tr class="table-headers">
                                <th class="text-decoration-none text-dark">Id usuaro</th>
                                <th class="text-decoration-none text-dark">Nombres</th>
                                <th class="text-decoration-none text-dark">Apellidos</th>
                                <?php if ($perfilUsuario === 'admin'): ?>
                                    <th class="text-decoration-none text-dark">Perfil</th>
                                <?php endif ?>
                                <th class="text-decoration-none text-dark">Correo</th>
                                <th class="text-decoration-none text-dark">Usuario</th>
                                <th class="text-decoration-none text-dark">Fecha de creación</th>
                                <th class="text-decoration-none text-dark">Estado</th>
                                <th class="actions"><?= __('Acciones') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?= h($user->id_usuario) ?></td>
                                    <td><?= h($user->nombres) ?></td>
                                    <td><?= h($user->apellidos) ?></td>
                                    <?php if ($perfilUsuario === 'admin'): ?>
                                        <td><?= h($user->perfil) ?></td>
                                    <?php endif ?>
                                    <td><?= h($user->correo) ?></td>
                                    <td><?= h($user->usuario) ?></td>
                                    <td><?= h($user->fecha_creacion) ?></td>
                                    <td> <span class="badge text-bg-<?= h($user->estado) == 1 ? 'success' : 'danger' ?>"><?= h($user->estado) == 1 ? 'Activo' : 'Inactivo' ?></span></td>
                                    <td class="actions">
                                        <?= $this->Html->link(__(''), ['action' => 'view', $user->id_usuario], [ 'class' => 'btn btn-info text-light bi bi-eye']) ?>
                                        <?= $this->Html->link(__(''), ['action' => 'edit', $user->id_usuario], [ 'class' => 'btn btn-warning text-light bi bi-pencil-square']) ?>
                                        <?php if ($perfilUsuario === 'admin'): ?>
                                            <?= $this->Html->link(__(''), '#', [
                                                'data-bs-toggle' => 'modal',
                                                'data-bs-target' => '#deleteModal',
                                                'data-userid' => $user->id_usuario,
                                                'data-usuario' => $user->usuario,
                                                'class' => 'btn btn-danger text-light bi bi-trash3',
                                            ]) ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- modal elmiinar -->
    <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <input type="hidden" id="id_user">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteModalLabel">Confirmar Eliminación</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body data-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button class="btn btn-danger text-light" id="confirmDeleteLink">Si</button>
                    <?= $this->Form->postLink(__(''), ['action' => 'delete', ''], [ 'class' => 'side-nav-item d-none']) ?>
                </div>
            </div>
        </div>
    </div>

    <div id="toast"></div>
</section>

<?= $this->Html->script('main')?>