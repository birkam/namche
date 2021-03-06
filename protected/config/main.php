<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',
	'timeZone' => 'Asia/Kathmandu',

	// preloading 'log' component
    'preload'=>array('log','bootstrap'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
        'application.extensions.*',
        'application.widget.bootstrap.*',
        'application.modules.rights.*',
        'application.modules.rights.components.*',
        'application.behaviors.ActiveRecordLogableBehavior',
		        'ext.SocialShareWidget.*',
//        'ext.EchMultiSelect.*',
	),

	'modules'=>array(
        'rights'=>array(

            'superuserName'=>'admin',
            'userNameColumn'=>'user_name',
            'userIdColumn'=>'id',
            'userClass'=>'UserAccount',

            'install'=>false,
        ),
		// uncomment the following to enable the Gii tool

		'gii'=>array(
            'generatorPaths'=>array(
                'bootstrap.gii',
            ),
			'class'=>'system.gii.GiiModule',
			'password'=>'password',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),

	),

	// application components
	'components'=>array(
        'user'=>array(
            'class' => 'RWebUser',
            // enable cookie-based authentication
            'allowAutoLogin'=>true,

            'authTimeout'=>100000,//5 minutes.
        ),
        'bootstrap'=>array(
            'class'=>'ext.bootstrap.components.Bootstrap',
            'responsiveCss'=>true,
            'fontAwesomeCss'=>true,
        ),
		// uncomment the following to enable URLs in path-format

		'urlManager'=>array(
            'showScriptName'=>false,
			'urlFormat'=>'path',
			'caseSensitive'=>false,
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                ''=>'Site/login',
			),
		),
        'authManager'=>array(
            'class'=>'RDbAuthManager',
            'defaultRoles'=>array('Guest'),
            'assignmentTable'=>'authassignment',
            'itemTable'=>'authitem',
            'itemChildTable'=>'authitemchild',
            'rightsTable'=>'rights',
        ),

//		'db'=>array(
//			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
//		),
		// uncomment the following to use a MySQL database

		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=db_namche_new',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page 
		'adminEmail'=>'webmaster@example.com',
	),
);