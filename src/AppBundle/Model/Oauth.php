<?php
/**
 * Created by PhpStorm.
 * User: fhm
 * Date: 27/09/16
 * Time: 13:34
 */

namespace AppBundle\Model;

use JMS\Serializer\Annotation As JMS;


class Oauth {
    /**
     * token d'accée aux API
     *
     * @var string
     * @JMS\Type("string")
     */
    private $access_token;

    /**
     * Durée du token en secondes
     *
     * @var integer
     * @JMS\Type("integer")
     */
    private $expires_in;

    /**
     * token pour le grant_type "refresh_token"
     *
     * @var string
     * @JMS\Type("string")
     */
    private $refresh_token;

    /**
     * @var string
     * @JMS\Type("string")
     */
    private $token_type;

    /**
     * @var string
     * @JMS\Type("string")
     */
    private $scope;

    /**
     * @return string
     */
    public function getAccessToken()
    {
        return $this->access_token;
    }

    /**
     * @return int
     */
    public function getExpiresIn()
    {
        return $this->expires_in;
    }

    /**
     * @return string
     */
    public function getRefreshToken()
    {
        return $this->refresh_token;
    }

    /**
     * @return string
     */
    public function getTokenType()
    {
        return $this->token_type;
    }

    /**
     * @return string
     */
    public function getScope()
    {
        return $this->scope;
    }

} 