<?php
/**
 * Created by PhpStorm.
 * User: fhm
 * Date: 28/11/16
 * Time: 00:30
 */

namespace AppBundle\Services;

use Symfony\Component\Security\Core\Encoder\EncoderFactory;
use FOS\UserBundle\Event as FOSUBEvent;
use FOS\RestBundle\Controller\Annotations as REST;
use FOS\UserBundle\Model\UserManager;
use JMS\DiExtraBundle\Annotation as DI;
use Doctrine\ORM\EntityManager;
/**
 * Class ApiService
 * @package AppBundle\Services
 * @DI\Service(id="Services_api")
 */
class ApiService {


    private $em;
    private $userManager;
    private $encoderFactory;

    /**
     * @param EntityManager $em
     * @param UserManager   $userManager
     * @param EncoderFactory   $encoderFactory
     * @DI\InjectParams(params={ "em" = @DI\Inject("doctrine.orm.entity_manager"),"userManager" = @DI\Inject("fos_user.user_manager"),"encoderFactory" = @DI\Inject("security.encoder_factory") })
     */
    public function __construct(EntityManager $em, UserManager $userManager, EncoderFactory $encoderFactory)
    {
        $this->em = $em;
        $this->userManager = $userManager;
        $this->encoderFactory = $encoderFactory;


    }

    public function addArticleService($article)
    {

    }

} 