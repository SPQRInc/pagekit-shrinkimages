<?php

namespace Spqr\Shrinkimages\Helper;

use Pagekit\Application as App;
use Pagekit\Application\Exception;
use Spatie\ImageOptimizer\OptimizerChainFactory;


/**
 * Class FileHelper
 * @package Spqr\Shrinkimages\Helper
 */
class FileHelper
{
	
	
	/**
	 * @param       $path
	 * @param null  $exclusions
	 * @param array $extensions
	 *
	 * @return array
	 */
	public function buildFilesTree( $path, $exclusions = null, $extensions = [ 'png', 'gif', 'jpg', 'jpeg', 'svg' ] )
	{
		$iterator = new \RecursiveIteratorIterator( new \RecursiveDirectoryIterator( $path ) );
		$files    = [];
		foreach ( $iterator as $file ) {
			if ( $file->isDir() )
				continue;
			
			if ( !empty( $exclusions ) ) {
				if ( is_array( $exclusions ) ) {
					foreach ( $exclusions as $exclusion ) {
						if ( strrpos( $file->getPathname(), $exclusion ) !== false )
							continue 2;
						
					}
				} else {
					if ( strrpos( $file->getPathname(), $exclusions ) !== false )
						continue;
				}
			}
			
			if ( in_array( $file->getExtension(), $extensions ) ) {
				$files[] = $file->getPathname();
			}
		}
		
		return $files;
	}
}