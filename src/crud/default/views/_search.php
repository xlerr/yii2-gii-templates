<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

echo "<?php\n";
?>

use yii\helpers\Html;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->searchModelClass, '\\') ?> */
/* @var $form kartik\widgets\ActiveForm */
?>

<div class="box box-default">
    <div class="box-header with-border">
        <div class="box-title"><?= "<?= " . $generator->generateString('Search') . " ?>" ?></div>
    </div>

    <div class="box-body">

    <?= "    <?php " ?>$form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
            'type'    => ActiveForm::TYPE_INLINE,
            'options' => [
                'data-pjax' => 1,
            ],
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
            <?= "<?= " ?>Html::resetButton(<?= $generator->generateString('Reset') ?>, ['class' => 'btn btn-default']) ?>
            <?= "<?= " ?>Html::a(<?= $generator->generateString('Create ' . Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>, ['create'], ['class' => 'btn btn-success']) ?>
        </div>

    <?= "    <?php " ?>ActiveForm::end(); ?>

    </div>
</div>