<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */

$this->title = $model-><?= $generator->getNameAttribute() ?>;
$this->params['breadcrumbs'][] = ['label' => <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<p>
    <?= "<?= " ?>Html::a(<?= $generator->generateString('Update') ?>, ['update', <?= $urlParams ?>], ['class' => 'btn btn-primary']) ?>
    <?= "<?= " ?>Html::a(<?= $generator->generateString('Delete') ?>, ['delete', <?= $urlParams ?>], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => <?= $generator->generateString('Are you sure you want to delete this item?') ?>,
            'method' => 'post',
        ],
    ]) ?>
    <?= "<?= " ?>Html::a(<?= $generator->generateString('Go Back') ?>, ['index'], ['class' => 'btn btn-default']) ?>
</p>

<div class="box box-primary">
    <div class="box-header with-border">
        <div class="box-title"><?= "<?= " . $generator->generateString('Detail') . " ?>" ?></div>
    </div>
    <div class="box-body no-padding">
<?= "        <?= " ?>DetailView::widget([
            'model' => $model,
            'options'    => [
                'class' => 'table table-striped',
            ],
            'attributes' => [
<?php
if (($tableSchema = $generator->getTableSchema()) === false) {
    foreach ($generator->getColumnNames() as $name) {
        echo "                '" . $name . "',\n";
    }
} else {
    foreach ($generator->getTableSchema()->columns as $column) {
        $format = $generator->generateColumnFormat($column);
        echo "                '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
    }
}
?>
            ],
        ]) ?>
    </div>
</div>
