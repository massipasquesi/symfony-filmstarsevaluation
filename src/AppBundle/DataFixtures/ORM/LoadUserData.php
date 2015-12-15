<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\DataFixtures\ORM\EasyDemoFixtures;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use AppBundle\Entity\User;

class LoadUserData extends LoadFixturesMaster
{

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @see Symfony\Component\DependencyInjection\ContainerInterface
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * [getNewEntityObject description]
     * @return [type] [description]
     */
    protected function getNewEntityObject()
    {
        return new User();
    }


    protected function declareHeader()
    {
        $this->header = array(
            'avatar' => 'file',
            'firstName',
            'lastName',
            'username',
            'email',
            'password' => 'password',
        );
    }

    public function getOrder()
    {
        return 2;
    }

    /**
     * [setPasswordType description]
     * @param [type] $var   [description]
     * @param [type] $value [description]
     */
    protected function setPasswordType($var, $value)
    {
        $encoder = $this->container->get('security.password_encoder');
        $this->setVar($var, $encoder->encodePassword($this, $value));

        return $value;
    }

    

}