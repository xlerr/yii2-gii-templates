# yii2-gii-templates

### example

```php
$config['modules']['gii'] = [
    'class' => 'yii\gii\Module',
    'generators' => [
        'crud' => [
            'class' => 'yii\gii\generators\crud\Generator',
            'templates' => [
                'myCrud' => '@vendor/xlerr/yii2-gii-templates/src/curd/default',
            ]
        ]
    ],
];
```