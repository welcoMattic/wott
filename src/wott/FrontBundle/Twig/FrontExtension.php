<?php
namespace wott\FrontBundle\Twig;

use wott\FrontBundle\Helper\PosterHelper;
use Tmdb\Client;
use Tmdb\Repository\ConfigurationRepository;

class FrontExtension extends \Twig_Extension
{
    private $helper;

    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;

        $repository = new ConfigurationRepository($client);
        $config     = $repository->load();

        $this->helper = new PosterHelper($config);
    }

    public function getFilters()
    {
        return array(
            'ms_in_hours' => new \Twig_Filter_Method($this, 'ms_in_hoursFilter'),
            new \Twig_SimpleFilter('image_url_path', array($this->helper, 'getUrlFromPath')),
        );
    }

    public function ms_in_hoursFilter($ms)
    {
        if ($ms > 3600)
            $h = floor($ms / 3600);
        $ms = $ms % 3600;

        return trim($h.'h').gmdate('i', $ms);
    }

    public function getName()
    {
        return 'front_extension';
    }

}
