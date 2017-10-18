<?php

use Pagekit\Application;


return [
	'name' => 'spqr/shrinkimages',
	'type' => 'extension',
	'main' => function( Application $app ) {
	},
	
	'autoload' => [
		'Spqr\\Shrinkimages\\' => 'src'
	],
	
	'routes' => [
		'/shrinkimages'     => [
			'name'       => '@shrinkimages',
			'controller' => [
				'Spqr\\Shrinkimages\\Controller\\ShrinkimagesController'
			]
		],
		'/api/shrinkimages' => [
			'name'       => '@shrinkimages/api',
			'controller' => [
				'Spqr\\Shrinkimages\\Controller\\ShrinkimagesApiController'
			]
		]
	],
	
	'widgets' => [],
	
	'menu' => [
		'shrinkimages'           => [
			'label'  => 'Shrink Images',
			'url'    => '@shrinkimages/settings',
			'active' => '@shrinkimages/settings*',
			'icon'   => 'spqr/shrinkimages:icon.svg'
		],
		'shrinkimages: settings' => [
			'parent' => 'shrinkimages',
			'label'  => 'Settings',
			'url'    => '@shrinkimages/settings',
			'access' => 'shrinkimages: manage settings'
		]
	],
	
	'permissions' => [
		'shrinkimages: manage settings' => [
			'title' => 'Manage settings'
		]
	],
	
	'settings' => '@shrinkimages/settings',
	
	'resources' => [
		'spqr/shrinkimages:' => ''
	],
	
	'config' => [
		'exclusions' => []
	],
	
	'events' => [
		'boot'         => function( $event, $app ) {
		},
		'site'         => function( $event, $app ) {
		},
		'view.scripts' => function( $event, $scripts ) use ( $app ) {
		}
	]
];