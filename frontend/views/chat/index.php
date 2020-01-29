<div id="chat" style="min-height: 100px; border: 1px solid #bbbbbb; padding: 5px; border-radius: 5px; margin-bottom: 5px;"></div>
<div>
    <div style="margin-bottom: 5px;">
        <?= \yii\helpers\Html::textInput('message', '', ['id' => 'message', 'class' => 'form-control']) ?>
    </div>

    <div style="display: flex; justify-content: flex-end">
        <?= \yii\helpers\Html::button('Send', ['id' => 'send', 'class' => 'btn btn-primary']) ?>
    </div>
</div>
<?php if (Yii::$app->user->isGuest) {
    $username = 'guest' . time();
} else {
    $username = Yii::$app->user->identity->username;
} ?>
<?= \yii\helpers\Html::hiddenInput('username', $username, ['class' => 'js-username']) ?>