<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;

//$success=false;
// if (Yii::$app->session->hasFlash('success')){
//     $success=true;
// }
$this->title = 'password reset token'
/* @var $this yii\web\View */
/* @var $model app\models\Userdb */
/* @var $form ActiveForm */
?>
<div class="site-userRepeatPassword">
    <?php if (!$showForm): ?>
        <?php $form = ActiveForm::begin(); ?>


        <?= $form->field($model, 'email')->input('email') ?>
        <?= $form->field($model, 'captcha')->widget(Captcha::className(),
            [
                'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
            ]) ?>


        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    <?php endif; ?>
</div><!-- site-userRepeatPassword -->
