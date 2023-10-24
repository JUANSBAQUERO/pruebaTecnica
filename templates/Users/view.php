<?= $this->element('header') ?>
<section class="content d-grid align-items-center px-3" style="height: 100vh;">
    <div class="container">
        <div class="card text-bg-secondary mb-3 shadow p-5">
            <div class="users index content">
                <div class="position-relative d-flex justify-content-between">
                    <div>
                        <h3><?= __('Información del Usuario') ?></h3>
                        <p>Aquí encontrara toda la información del usuario <span class="fw-bold"><?= h($user->nombres) ?> <?= h($user->apellidos) ?></span>.</p>
                    </div>
                    <div>
                    <?= $this->Html->Link(__('Volver a la lista de usuarios'), ['action' => 'index'], ['class' => 'text-aqua text-decoration-none']) ?>
                    </div>
                </div>
                <hr class="border-bottom border-ligth border-3">
                <div class="row justify-content-space-between">
                    <div class="col-lg-6">
                        <table>
                            <tr>
                                <th><i class="me-3 text-aqua bi bi-info-circle-fill"></i> <?= __('Id Usuario') ?></th>
                                <td class="ps-3"><?= h($user->id_usuario) ?></td>
                            </tr>
                            <tr>
                                <th><i class="me-3 text-aqua bi bi-person-fill-gear"></i> <?= __('Nombres') ?></th>
                                <td class="ps-3"><?= h($user->nombres) ?></td>
                            </tr>
                            <tr>
                                <th><i class="me-3 text-aqua bi bi-person-fill-gear"></i> <?= __('Apellidos') ?></th>
                                <td class="ps-3"><?= h($user->apellidos) ?></td>
                            </tr>
                            <tr>
                                <th><i class="me-3 text-aqua bi bi-<?= h($user->estado) ? 'check2-circle' : 'x-circle' ?>"></i> <?= __('Estado') ?></th>
                                <td class="ps-3"><span class="shadow badge text-bg-<?= h($user->estado) ? 'success' : 'danger' ?>"><?= h($user->estado) ? 'Activo' : 'Inactivo' ?></span></td>
                            </tr>
                            <tr>
                                <th><i class="me-3 text-aqua bi bi-calendar-check"></i> <?= __('Fecha Creacion') ?></th>
                                <td class="ps-3"><?= h($user->fecha_creacion) ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-6 border-start border-ligth border-3 ps-5">
                        <div class="d-flex align-items-center">
                            <div class="fs-4 me-3">
                                <i class="text-aqua bi bi-person-badge"></i>
                            </div>
                            <div class="text">
                                <strong><?= __('Usuario') ?></strong>
                                <blockquote class="mb-0">
                                    <?= $this->Text->autoParagraph(h($user->usuario)); ?>
                                </blockquote>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mt-3">
                            <div class="fs-4 me-3">
                                <i class="text-aqua bi bi-envelope-at"></i>
                            </div>
                            <div class="text ">
                                <strong><?= __('Correo') ?></strong>
                                <blockquote class="mb-0">
                                    <?= $this->Text->autoParagraph(h($user->correo)); ?>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
