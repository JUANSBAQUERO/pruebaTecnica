<nav class="navbar bg-secondary position-fixed w-100 shadow z-3">
    <div class="container-fluid mx-5">
        <a class="navbar-brand text-light" href="#">
            <?= $this->Html->image('icono.png', ['alt' => 'logo', 'width' => 30]) ?>
            Divisa One
        </a>
        <div class="bg-light px-2 py-1 rounded-circle">
            <?= $this->Html->link(__(''), ['action' => 'logout'], ['class' => 'text-dark bi bi-door-open']) ?>
        </div>
    </div>
</nav>