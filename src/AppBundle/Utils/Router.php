<?php
/**
 * Created by PhpStorm.
 * User: SEDONAINTRA\bdemalglaive
 * Date: 17/08/15
 * Time: 13:42
 */


namespace AppBundle\Utils;


class Router extends \Symfony\Bundle\FrameworkBundle\Routing\Router {


    /**
     * {@inheritdoc}
     */
    public function generate($name, $parameters = array(), $referenceType = self::ABSOLUTE_PATH)
    {
        $route = $this->getGenerator()->generate($name, $parameters, $referenceType);
        return $route;
    }
}