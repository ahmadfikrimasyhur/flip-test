<?php
$this->title = 'My Marketplace';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Welcome back<?php echo Yii::$app->user->isGuest ? '' : ', '.Yii::$app->user->identity->username ?>!</h1>
    </div>

</div>