<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use AppBundle\Exception\AppBundleException as Exception;

abstract class EasyDemoFixtures extends AbstractFixture
{
    protected $demoFixtures;
    protected $keyMapper;

    abstract protected function getNewEntityObject();
    abstract protected function definekeyMapper();
    abstract protected function defineDemoFixtures();

    public function __construct()
    {
        $this->defineKeyMapper();
        $this->defineDemoFixtures();
    }

    public function getDemoFixtures()
    {
        if ($this->checkDemoFixtures() !== true) {
            throw new Exception("DemoFixture array is not like expected");
        }

        return $this->demoFixtures;
    }

    protected function checkDemoFixtures()
    {
        if (isset($this->demoFixtures) &&
            !empty($this->demoFixtures) &&
            is_array($this->demoFixtures)) {
                return true;
        }

        return false;
    }

    public function easyLoad(ObjectManager $manager, $special = array())
    {
        foreach ($this->getDemoFixtures() as $movie_row) {
            $newFObject = $this->getNewEntityObject();

            foreach ($this->keyMapper as $i => $attr) {
                if (array_key_exists($attr, $special)) {
                    call_user_func_array(array($this, $special[$attr]), array($newFObject, &$movie_row[$i]));
                }
                $setter = 'set' . ucfirst($attr);
                call_user_func_array(array($newFObject, $setter), array($movie_row[$i]));
            }

            $manager->persist($newFObject);
            $manager->flush();

            unset($newFObject);
        }
    }
}