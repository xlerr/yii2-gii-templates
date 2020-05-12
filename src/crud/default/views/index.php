<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();
$nameAttribute = $generator->getNameAttribute();

echo "<?php\n";
?>

use yii\web\View;
use yii\data\ActiveDataProvider;
use <?= $generator->indexWidgetType === 'grid' ? "xlerr\\common\\widgets\\GridView" : "yii\\widgets\\ListView" ?>;
<?= $generator->enablePjax ? 'use xlerr\\common\\widgets\\Pjax;' : '' ?>

/* @var $this View */
/* @var $dataProvider ActiveDataProvider */
<?= !empty($generator->searchModelClass) ? "/* @var \$searchModel \\" . ltrim($generator->searchModelClass, '\\') . " */\n" : '' ?>

$this->title = <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>;
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $generator->enablePjax ? '<?php Pjax::begin(); ?>' : '' ?>

<?php if(!empty($generator->searchModelClass)): ?>
<?= "<?= " ?>$this->render('_search', ['model' => $searchModel]); ?>
<?php endif; ?>

<?php if ($generator->indexWidgetType === 'grid'): ?>
<?= "<?= " ?>GridView::widget([
    'dataProvider' => $dataProvider,
    <?= !empty($generator->searchModelClass) ? "// 'filterModel' => \$searchModel,\n    'columns' => [\n" : "'columns' => [\n"; ?>
        ['class' => 'yii\grid\ActionColumn'],

<?php
$count = 0;
if (($tableSchema = $generator->getTableSchema()) === false) {
    foreach ($generator->getColumnNames() as $name) {
        if (++$count < 6) {
            echo "        '" . $name . "',\n";
        } else {
            echo "        // '" . $name . "',\n";
        }
    }
} else {
    foreach ($tableSchema->columns as $column) {
        $format = $generator->generateColumnFormat($column);
        if (++$count < 6) {
            echo "        '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
        } else {
            echo "        // '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
        }
    }
}
?>

    ],
]); ?>
<?php else: ?>
    <?= "<?= " ?>ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            return Html::a(Html::encode($model-><?= $nameAttribute ?>), ['view', <?= $urlParams ?>]);
        },
    ]) ?>
<?php endif; ?>
<?= $generator->enablePjax ? '<?php Pjax::end(); ?>' : '' ?>
