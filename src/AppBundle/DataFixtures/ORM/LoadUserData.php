<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\DataFixtures\ORM\EasyDemoFixtures;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use AppBundle\Entity\User;

class LoadUserData extends EasyDemoFixtures implements OrderedFixtureInterface, ContainerAwareInterface
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

    /**
     * [defineKeyMapper description]
     * @return [type] [description]
     */
    protected function defineKeyMapper()
    {
        $this->keyMapper = array(
            'firstName',
            'lastName',
            'username',
            'email',
            'password',
        );
    }

    /**
     * [defineDemoFixtures description]
     * @return [type] [description]
     */
    protected function defineDemoFixtures()
    {
        $this->demoFixtures = array(
            array('massi', 'zero', 'massizero', 'massizero@yopmail.com', 'pmassi001'),
            array('user', 'one', 'user1one', 'user1one@yopmail.com', 'puserone100'),
            array('user', 'two', 'user2two', 'user2two@yopmail.com', 'pusertwo200'),
            array('user', 'three', 'user3three', 'user3three@yopmail.com', 'puserthree300'),
        );
    }

    /**
     * [load description]
     * @param  ObjectManager $manager [description]
     * @return [type]                 [description]
     */
    public function load(ObjectManager $manager)
    {
        $special = array('password' => 'encodePassword');
        $this->easyLoad($manager, $special);
    }

    /**
     * [encodePassword description]
     * @param  [type] $password [description]
     * @return [type]           [description]
     */
    protected function encodePassword(User $userObject, &$password)
    {
        $encoder = $this->container->get('security.password_encoder');
        $password = $encoder->encodePassword($userObject, $password);

        return $password;
    }

    public function getOrder()
    {
        return 2;
    }

    

    

}