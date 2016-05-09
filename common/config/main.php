<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
		'authManager' => [
			'class' => 'yii\rbac\DbManager',
		],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
        'modules' => [
        'auth' => [
            'class' => 'common\modules\auth\Module',
        ],
    ],
];
