<?php
$this->title = 'My Marketplace';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Welcome back<?php echo Yii::$app->user->isGuest ? '' : ', '.Yii::$app->user->identity->username ?>!</h1>
        <p>
        <?php
        $dbopts = parse_url(getenv('DATABASE_URL'));
        
        var_dump($dbopts);
        ?>
        </p>
    </div>

</div>