<?php

namespace wott\FrontBundle\Helper;
use Tmdb\Helper\ImageHelper;

class PosterHelper extends ImageHelper
{
	public function getUrlFromPath($path, $size = 'original')
	    {
	        $config= $this->getImageConfiguration();

	        return $config['base_url'] . $size . $path;
	    }
 }