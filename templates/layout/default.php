<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'Prueba Tecnica';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <?= $this->Html->meta('icon', 'icono.png') ?>
    <?= $this->Html->css(['home', 'bootstrap.min', 'DataTable/datatables.bootstrap4.min', 'DataTable/responsivebootstrap4.min']) ?>

    <?= $this->Html->script(['jquery-3.7.1.min', 'DataTable/jquery.dataTables.min', 'DataTable/moment', 'DataTable/sort', 'DataTable/date-time', 'bootstrap.min',  'DataTable/dataTables.bootstrap4.min', 'DataTable/dataTables.buttons.min', 'DataTable/buttons.html5.min', 'DataTable/jsZip.min', 'DataTable/buttons.bootstrap4.min', 'DataTable/buttons.colVis.min', 'DataTable/buttons.print.min', 'DataTable/dataTables.responsive.min', 'DataTable/pdfmake.min', 'DataTable/vfs_fonts',  'maintable']) ?>


    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <?= $this->element('loader') ?>
    <main class="main">
        <?= $this->fetch('content') ?>
    </main>
    <footer>
    </footer>

    <script>
        window.addEventListener('load', function() {
            setTimeout(() => {
                $('.loader-overlay').hide();
            }, 1000);
        });
    </script>
</body>
</html>
