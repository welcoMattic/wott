<?php

namespace wott\FrontBundle\Helper;
use Tmdb\Helper\ImageHelper;

class PosterHelper extends ImageHelper
{
    public function getUrlFromPath($path, $size = 'original')
    {
        $config = $this->getImageConfiguration();

        return $path === '' ? "{{ asset('bundles/wottfront/images/noposter.png') }}" : $config['base_url'] . $size . $path;
    }
 }
