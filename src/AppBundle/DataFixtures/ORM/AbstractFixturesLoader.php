<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use AppBundle\Exception\AppBundleException as Exception;

abstract class AbstractFixturesLoader extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    abstract public function getOrder();
    abstract protected function declareHeader();
    abstract protected function getNewEntityObject();

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

    public function __call($name, array $arguments)
    {
        if (strpos($name, "set") === 0) {
            $variable = lcfirst(str_replace("set", '', $name));
            $this->$variable = $arguments[0];
        } else if (strpos($name, "get") === 0) {
            $variable = lcfirst(str_replace("get", '', $name));
            return $this->$variable;
        } else if (strpos($name, "isSet") === 0) {
            $variable = lcfirst(str_replace("isSet", '', $name));
            return isset($this->$variable);
        }
    }

    /**
     * [load description]
     * @param  ObjectManager $manager [description]
     * @return [type]                 [description]
     */
    public function load(ObjectManager $manager)
    {
        $this->funkyLoad($manager);
    }

    protected function getDemoFixtures()
    {
        switch (true) {
            case (isset($this->demoFixturesArray)):
                return $this->demoFixturesArray;
                break;
            case (isset($this->demoFixturesJson)):
                return $this->demoFixturesJson;
                break;
            default:
                # code...
                break;
        }
       
    }

    protected function funkyLoad(ObjectManager $manager)
    {
        foreach ($this->getDemoFixtures() as $row) {
            $this->newFObject = $this->getNewEntityObject();

            $i = 0;
            foreach ($this->getHeader() as $key => $attr) {
                if (!is_numeric($key)) {
                    $type = $attr;
                    $attr = $key;
                    $setter = 'set' . ucfirst($type);
                } else {
                    $setter = 'set' . ucfirst($attr);
                }

                $typeSetter = $setter . 'Type';

                switch (true) {
                    case (method_exists($this, $typeSetter)):
                        $this->$typeSetter($manager, $row[$i]);
                        break;
                    default:
                        $this->setVar($attr, $row[$i]);
                        break;
                }
                $i++;
            }

            $manager->persist($this->newFObject);
            $manager->flush();

            unset($this->newFObject);
        }
    }

    public function getHeader()
    {
        if (!$this->isSetHeader()) {
            $this->declareHeader();
        }
        
        return $this->header;
    }

    protected function setVar($var, $value)
    {
        switch (true) {
            case (method_exists($this->newFObject, 'set' . ucfirst($var))):
                call_user_func_array(array($this->newFObject, 'set' . ucfirst($var)), array($value));
                break;
            default:
                $this->newFObject->{$var} = $value;
                break;
        }
    }
}
