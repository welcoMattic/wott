<?php
namespace wott\FrontBundle\Twig;

class FrontExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            'ms_in_hours' => new \Twig_Filter_Method($this, 'ms_in_hoursFilter'),
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
