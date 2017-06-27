<?php

namespace AppBundle\Controller\Api;


use AppBundle\Model\MessageContent;
use AppBundle\Model\ResponseContainer;
use AppBundle\Utils\InternalErrorCodes;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AbstractApiController.
 */
abstract class AbstractApiController extends FOSRestController
{
    /**
     * @param string $message
     * @param int $httpCode
     * @param array $parameters
     * @return Response
     */
    protected function sendResponseSuccessMessage($message = "", $httpCode = Response::HTTP_OK, array $parameters = [])
    {
        $messageContent = new MessageContent();
        $messageContent->setText($this->get("translator")->trans($message, $parameters));
        return $this->sendResponse($messageContent, $httpCode);
    }

    /**
     * @param string $message
     * @param int $httpCode
     * @param array $parameters
     * @return Response
     */
    protected function sendResponseWarningMessage($message = "", $httpCode = Response::HTTP_OK, array $parameters = [])
    {
        $messageContent = new MessageContent(MessageContent::TYPE_WARNING);
        $messageContent->setText($this->get("translator")->trans($message, $parameters));
        return $this->sendResponse($messageContent, $httpCode);
    }

    /**
     * send a success response with data.
     *
     * @param array $data
     * @param int   $httpCode
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function sendResponseSuccess($data = array(), $httpCode = Response::HTTP_OK)
    {
        return $this->sendResponse($data, $httpCode);
    }
    /**
     * send one error : message + code.
     *
     * @param string $message           message in response JSON
     * @param int    $internalErrorCode Error code in response JSON
     * @param int    $httpCode          HTTP Error code
     * @param array  $parametres
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     */
    protected function sendResponseError($message,$httpCode = Response::HTTP_INTERNAL_SERVER_ERROR,array $parameters = [] )
    {

        $response = ["message" =>["type" => "E", "text" => $this->get('translator')->trans($message, $parameters)]];

        return $this->sendResponse(
            $response,
            $httpCode
        );
    }


    /**
     * Envoi une réponse HTTP avec son code (200 par défaut) en JSON.
     *
     * @param $data
     * @param int $httpCode code http
     * @return Response
     */
    private function sendResponse($data, $httpCode = Response::HTTP_OK)
    {
        $request = $this->get('request_stack')->getCurrentRequest();
        $view = $this->view($data, $httpCode);
        $acceptHeader = $request->headers->get('Accept');
        $format = ($acceptHeader === 'application/xml') ? 'xml' : 'json';
        $view->setFormat($format);

        return $this->handleView($view);
    }




}

