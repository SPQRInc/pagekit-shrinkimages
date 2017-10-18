<?php

namespace Spqr\Shrinkimages\Helper;

use Pagekit\Application as App;
use Pagekit\Application\Exception;
use Spatie\ImageOptimizer\OptimizerChainFactory;


/**
 * Class ImageHelper
 * @package Spqr\Shrinkimages\Helper
 */
class ImageHelper
{
	/**
	 * @var
	 */
	protected $optimizerChain;
	
	/**
	 * ImageHelper constructor.
	 */
	public function __construct()
	{
		$this->optimizerChain = OptimizerChainFactory::create();
	}
	
	/**
	 * @param $file
	 *
	 * @return bool
	 */
	public function processFile( $file )
	{
		try {
			$this->optimizerChain->optimize( $file );
		} catch ( \Exception $e ) {
			throw new Exception( __( 'Unable to optimize files.' ) );
		}
		
		return true;
	}
	
}