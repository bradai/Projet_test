<?php
/**
 * Created by PhpStorm.
 * User: SEDONAINTRA\bdemalglaive
 * Date: 21/09/16
 * Time: 19:48
 */

namespace AppBundle\Model;

use JMS\Serializer\Annotation As JMS;


class MessageContent
{
    const TYPE_SUCCESS = "S";
    const TYPE_WARNING = "W";
    const TYPE_ERROR = "E";

    /**
     * Enum("S", "E", "W")
     *
     * @var String
     * @JMS\Type("string")
     */
    private $type;

    /**
     * code erreur
     *
     * @var String
     * @JMS\Type("string")
     */
    private $code;

    /**
     * message a afficher a l'utilisateur
     *
     * @var String
     * @JMS\Type("string")
     */
    private $text;

    /**
     * @param string $type
     */
    public function __construct($type = self::TYPE_SUCCESS) {
        $this->type = $type;
    }

    /**
     * @return String
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param String $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return String
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param String $text
     * @return $this
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return String
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param String $code
     * @return $this
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

}