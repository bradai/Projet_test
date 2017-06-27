<?php
/**
 * Created by PhpStorm.
 * User: SEDONAINTRA\bdemalglaive
 * Date: 21/09/16
 * Time: 19:48
 */

namespace AppBundle\Model;

use JMS\Serializer\Annotation As JMS;


class ResponseContainer
{
    /**
     * @var MessageContent
     * @JMS\Type("AppBundle\Model\MessageContent")
     */
    private $message;

    /**
     * @var array
     * @JMS\Type("array")
     */
    private $list;

    /**
     * @JMS\Expose()
     */
    private $object;

    /**
     * @param $object
     */
    public function __construct($object)
    {
        $this->message = null;
        $this->list = null;
        $this->object = null;

        if($object instanceof MessageContent) {
            $this->message = $object;
        } elseif(is_array($object)) {
            $this->list = $object;
        } else {
            $this->object = $object;
        }
    }

    /**
     * @return MessageContent
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param MessageContent $message
     * @return $this
     */
    public function setMessage(MessageContent $message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @return array
     */
    public function getList()
    {
        return $this->list;
    }

    /**
     * @param array $list
     * @return $this
     */
    public function setList($list)
    {
        $this->list = $list;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * @param mixed $object
     * @return $this
     */
    public function setObject($object)
    {
        $this->object = $object;
        return $this;
    }
}