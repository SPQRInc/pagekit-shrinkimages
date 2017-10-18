<?php

namespace Spqr\Shrinkimages\Controller;

use Pagekit\Application as App;


/**
 * @Access(admin=true)
 * @return string
 */
class ShrinkimagesController
{
	/**
	 * @return mixed
	 */
	public function indexAction()
	{
		return App::response()->redirect( '@shrinkimages/settings' );
	}
	
	/**
	 * @Access("shrinkimages: manage settings")
	 */
	public function settingsAction()
	{
		$module = App::module( 'spqr/shrinkimages' );
		$config = $module->config;
		
		return [
			'$view' => [
				'title' => __( 'Shrinkimages Settings' ),
				'name'  => 'spqr/shrinkimages:views/admin/settings.php'
			],
			'$data' => [
				'config' => App::module( 'spqr/shrinkimages' )->config()
			]
		];
	}
	
	/**
	 * @Request({"config": "array"}, csrf=true)
	 * @param array $config
	 *
	 * @return array
	 */
	public function saveAction( $config = [] )
	{
		App::config()->set( 'spqr/shrinkimages', $config );
		
		return [ 'message' => 'success' ];
	}
	
}