<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Acerca';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        Esta es la página Acerca de. Puede modificar el siguiente archivo para personalizar su contenido:
    </p>

    <code><?= __FILE__ ?></code>
</div>
