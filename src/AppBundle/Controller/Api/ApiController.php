<?php
/**
 * Created by PhpStorm.
 * User: fhm
 * Date: 27/11/16
 * Time: 22:51
 */

namespace AppBundle\Controller\Api;

use AppBundle\Utils\InternalErrorCodes;
use FOS\RestBundle\Controller\Annotations as REST;
use FOS\UserBundle\Event as FOSUBEvent;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use OAuth2\OAuth2ServerException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Controller\Api\AbstractApiController;
use Hateoas\Representation\Factory\PagerfantaFactory;
use JMS\Serializer\SerializationContext;
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;



class ApiController extends AbstractApiController{



    /**
     * Récupère la liste des fiouls
     *
     * @Route ("/api/fiouls/{id}/{date1}/{date2}", name="api_show_fioul")
     * @Method("GET")

     */
    public function ShowAction($id,$date1,$date2){

        try{
            $Fiouls = $this->getDoctrine()->getRepository('AppBundle:Fioul')->searchFiouls( $id, $date1, $date2);
            $FioulsModel = [];
            foreach($Fiouls as $Fioul) {
                $FioulsModel[] = $Fioul;
            }
            return $this->sendResponseSuccess($FioulsModel);

        } catch (OAuth2ServerException $exc) {
            return $this->sendResponseError($exc->getDescription(), $exc->getHttpCode());
        }


    }


}