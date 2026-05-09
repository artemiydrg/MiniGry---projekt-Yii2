<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = 'Rejestracja';
?>
<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div style="background:white; border-radius:15px; padding:40px;
                box-shadow:0 10px 40px rgba(0,0,0,0.2); max-width:400px; width:100%;">

        <h2 class="text-center mb-4">🎮 Zarejestruj się</h2>

        <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'username')->textInput([
                'placeholder' => 'Nazwa użytkownika',
                'class' => 'form-control'
            ])->label('Nazwa użytkownika') ?>

            <?= $form->field($model, 'password')->passwordInput([
                'placeholder' => 'Min. 6 znaków',
                'class' => 'form-control'
            ])->label('Hasło') ?>

            <?= $form->field($model, 'confirm_password')->passwordInput([
                'placeholder' => 'Powtórz hasło',
                'class' => 'form-control'
            ])->label('Potwierdź hasło') ?>

            <div class="d-grid mt-3">
                <?= Html::submitButton('Zarejestruj się', [
                    'class' => 'btn btn-primary w-100'
                ]) ?>
            </div>

        <?php ActiveForm::end(); ?>

        <div class="text-center mt-3">
            <p>Masz już konto? 
                <?= Html::a('Zaloguj się', ['site/login']) ?>
            </p>
        </div>
    </div>
</div>