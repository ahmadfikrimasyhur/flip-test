<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Disbursement';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-withdraw">
    <h1><?= Html::encode($this->title) ?></h1>

    <h2><?= Html::encode($this->title) ?> Request</h2>

    <div class="row">
        <div class="col-lg-12">

            <?php 
            echo GridView::widget([
                'dataProvider' => $dataProviderReq,
            ]);
            ?>

            <?php if (Yii::$app->session->hasFlash('disburseReqSubmitted')): ?>

            <div class="alert alert-success">
            Disbursement Request submitted.
            </div>

            <?php endif; ?>

            <?= Html::a('Submit', ['/site/disburse-submit'], ['class' => 'btn btn-primary pull-right']) ?>

        </div>
    </div>

    <h2><?= Html::encode($this->title) ?> Pending</h2>

    <div class="row">
        <div class="col-lg-12">

            <?php 
            echo GridView::widget([
                'dataProvider' => $dataProviderPending,
            ]);
            ?>

            <?php if (Yii::$app->session->hasFlash('disbursePendingSubmitted')): ?>

            <div class="alert alert-success">
            Disbursement Pending updated.
            </div>

            <?php endif; ?>

            <?= Html::a('Update', ['/site/disburse-update'], ['class' => 'btn btn-primary pull-right']) ?>

        </div>
    </div>

    <h2><?= Html::encode($this->title) ?> Success</h2>

    <div class="row">
        <div class="col-lg-12">

            <?php 
            echo GridView::widget([
                'dataProvider' => $dataProviderSuccess,
            ]);
            ?>

        </div>
    </div>
</div>