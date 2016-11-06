<?php

use hipanel\modules\dashboard\widgets\ObjectsCountWidget;
use hipanel\modules\dashboard\widgets\SmallBox;
use yii\helpers\Html;

$this->title = Yii::t('hipanel:dashboard', 'Dashboard');

/**
 * @var array $totalCount
 * @var \hipanel\modules\client\models\Client $model
 */

?>

<div class="row">
    <?php if (Yii::getAlias('@domain', false)) : ?>
        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
            <?php $box = SmallBox::begin([
                'boxTitle' => Yii::t('hipanel', 'Domains'),
            ]) ?>
            <?php $box->beginBody() ?>
            <?= ObjectsCountWidget::widget([
                'totalCount' => $totalCount['domains'],
                'ownCount' => $model->count['domains'],
            ]) ?>
            <?php $box->endBody() ?>
            <?php $box->beginFooter() ?>
            <?php if (Yii::$app->user->can('support')) : ?>
                <?= Html::a(Yii::t('hipanel', 'View') . $box->icon(), '@domain/index', ['class' => 'small-box-footer']) ?>
            <?php endif ?>
            <?php if ($model->count['contacts']) : ?>
                <?= Html::a(Yii::t('hipanel', 'Contacts') . ': ' . $model->count['contacts'] . $box->icon(), '@contact/index', ['class' => 'small-box-footer']) ?>
            <?php endif ?>
            <?php if (Yii::$app->user->can('deposit')) : ?>
                <?= Html::a(Yii::t('hipanel', 'Buy') . $box->icon('fa-shopping-cart'), '@domain/buy', ['class' => 'small-box-footer']) ?>
            <?php endif ?>
            <?php $box->endFooter() ?>
            <?php $box::end() ?>
        </div>
    <?php endif ?>

    <?php if (Yii::getAlias('@server', false)) : ?>
        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
            <?php $box = SmallBox::begin([
                'boxTitle' => Yii::t('hipanel', 'Servers'),
                'boxIcon' => 'fa-server',
                'boxColor' => SmallBox::COLOR_TEAL,
            ]) ?>
            <?php $box->beginBody() ?>
            <?= ObjectsCountWidget::widget([
                'totalCount' => $totalCount['servers'],
                'ownCount' => $model->count['servers'],
            ]) ?>
            <?php $box->endBody() ?>
            <?php $box->beginFooter() ?>
            <?php if ($model->count['servers'] || Yii::$app->user->can('support')) : ?>
                <?= Html::a(Yii::t('hipanel', 'View') . $box->icon(), '@server/index', ['class' => 'small-box-footer']) ?>
            <?php endif ?>
            <?php if (Yii::$app->user->can('deposit')) : ?>
                <?= Html::a(Yii::t('hipanel', 'Buy') . $box->icon('fa-shopping-cart'), '@server/buy', ['class' => 'small-box-footer']) ?>
            <?php endif ?>
            <?php $box->endFooter() ?>
            <?php $box::end() ?>
        </div>
    <?php endif ?>

    <?php if (Yii::getAlias('@ticket', false)) : ?>
        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
            <?php $box = SmallBox::begin([
                'boxTitle' => Yii::t('hipanel', 'Tickets'),
                'boxIcon' => 'fa-ticket',
                'boxColor' => SmallBox::COLOR_ORANGE,
            ]) ?>
            <?php $box->beginBody() ?>
            <?= ObjectsCountWidget::widget([
                'totalCount' => $totalCount['tickets'],
                'ownCount' => $model->count['tickets'],
            ]) ?>
            <?php $box->endBody() ?>
            <?php $box->beginFooter() ?>
            <?= Html::a(Yii::t('hipanel', 'View') . $box->icon(), '@ticket/index', ['class' => 'small-box-footer']) ?>
            <?= Html::a(Yii::t('hipanel', 'Create') . $box->icon('fa-plus'), '@ticket/create', ['class' => 'small-box-footer']) ?>
            <?php $box->endFooter() ?>
            <?php $box::end() ?>
        </div>
    <?php endif ?>

    <?php if (Yii::getAlias('@bill', false) && Yii::$app->user->can('deposit')) : ?>
        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
            <?php $box = SmallBox::begin([
                'boxTitle' => Yii::t('hipanel', 'Credit'),
                'boxIcon' => 'fa-money',
                'boxColor' => SmallBox::COLOR_RED,
            ]) ?>
            <?php $box->beginBody() ?>
            <span style="font-size: 18px"></span><?= Yii::$app->formatter->asCurrency($model->balance, $model->currency) ?>
            <?php if ($model->credit > 0) : ?>
                <small><?= Yii::t('hipanel', 'Credit') . ' ' . Yii::$app->formatter->asCurrency($model->credit, $model->currency) ?></small>
            <?php endif ?>
            <?php $box->endBody() ?>
            <?php $box->beginFooter() ?>
            <?= Html::a(Yii::t('hipanel', 'View') . $box->icon(), '@bill/index', ['class' => 'small-box-footer']) ?>
            <?= Html::a(Yii::t('hipanel', 'Recharge') . $box->icon('fa-credit-card-alt'), '@pay/deposit', ['class' => 'small-box-footer']) ?>
            <?php $box->endFooter() ?>
            <?php $box::end() ?>
        </div>
    <?php endif ?>
</div>
