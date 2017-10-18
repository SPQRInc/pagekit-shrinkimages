<?php

namespace Spqr\Shrinkimages\Controller;

use Spqr\Shrinkimages\Helper\ImageHelper;
use Spqr\Shrinkimages\Helper\FileHelper;

use Pagekit\Application as App;

/**
 * @Access("shrinkimages: manage images")
 * @Route("shrinkimage", name="shrinkimage")
 */
class ShrinkimagesApiController
{
	
	/**
	 * @Route("/prepare", methods="POST")
	 * @Request(csrf=true)
	 *
	 * @return array
	 *
	 */
	public function prepareAction()
	{
		$config      = App::module( 'spqr/shrinkimages' )->config();
		$exclusions  = $config[ 'exclusions' ];
		$file_helper = new FileHelper;
		$files_tree  = $file_helper->buildFilesTree( App::get( 'path.storage' ), $exclusions );
		
		return [ 'message' => 'success', 'files' => $files_tree ];
	}
	
	/**
	 * @param array $files
	 *
	 * @Route("/shrink", methods="POST")
	 * @Request({"files": "array"}, csrf=true)
	 *
	 * @return array
	 *
	 */
	public function shrinkAction( $files = [] )
	{
		$image_helper = new ImageHelper;
		
		for ( $i = 0; $i < 1; $i++ ) {
			$image_helper->processFile($files[$i]);
			unset($files[$i]);
		}
		
		$files = array_values($files);
		
		return [ 'message' => 'success', 'files' => $files ];
	}
	
}