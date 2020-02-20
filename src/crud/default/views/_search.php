<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\web\View;
use xlerr\common\widgets\ActiveForm;

/* @var $this View */
/* @var $model \<?= ltrim($generator->searchModelClass, '\\') ?> */
?>

<div class="box box-default search">
    <div class="box-header with-border">
        <i class="glyphicon glyphicon-search"></i>
        <h3 class="box-title"><?= $generator->generateString('Search') ?></h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>

    <div class="box-body">

    <?= "    <?php " ?>$form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
            'type'    => ActiveForm::TYPE_INLINE,
            'waitingPrompt' => ActiveForm::WAITING_PROMPT_SEARCH,
        ]); ?>

<?php
$count = 0;
foreach ($generator->getColumnNames() as $attribute) {
    if (++$count < 6) {
        echo "        <?= " . $generator->generateActiveSearchField($attribute) . " ?>\n\n";
    } else {
        echo "        <?php // echo " . $generator->generateActiveSearchField($attribute) . " ?>\n\n";
    }
}
?>
        <div class="form-group">
            <?= "<?= " ?>Html::submitButton(<?= $generator->generateString('Search') ?>, ['class' => 'btn btn-primary']) ?>
            <?= "<?= " ?>Html::a(<?= $generator->generateString('Reset') ?>, ['index'], ['class' => 'btn btn-default']) ?>
            <?= "<?= " ?>Html::a(<?= $generator->generateString('Create ' . Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>, ['create'], ['class' => 'btn btn-success']) ?>
        </div>

    <?= "    <?php " ?>ActiveForm::end(); ?>

    </div>
</div>