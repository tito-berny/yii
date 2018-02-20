<?php
/**
 * Created by PhpStorm.
 * User: bernabe
 * Date: 19/2/18
 * Time: 12:04
 */

use yii\helpers\Html;
?>
<p>Usted ha ingresado la siguiente información:</p>

<ul>
    <li><label>Nombre</label>: <?= Html::encode($model->name) ?></li>
    <li><label>Email</label>: <?= Html::encode($model->email) ?></li>
</ul>