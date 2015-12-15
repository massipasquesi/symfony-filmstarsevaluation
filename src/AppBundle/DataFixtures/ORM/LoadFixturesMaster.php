<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use AppBundle\Exception\AppBundleException as Exception;

class LoadFixturesMaster extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    protected $demoFixtures = array(
        'user' => array(
            array(0, 'massi', 'zero', 'massizero', 'massizero@yopmail.com', 'pmassi001'),
            array(1, 'user', 'one', 'user1one', 'user1one@yopmail.com', 'puserone100'),
            array(2, 'user', 'two', 'user2two', 'user2two@yopmail.com', 'pusertwo200'),
            array(3, 'user', 'three', 'user3three', 'user3three@yopmail.com', 'puserthree300'),
        ),
        'movie' => array(
            array(1, 'Forrest Gump', 'Robert Zemeckis', '1994'),
            array(2, 'La ligne verte', 'Frank Darabont', '2000'),
            array(3, 'Django Unchained', 'Quentin Tarantino', '2013'),
            array(4, 'Rain Man', 'Barry Levinson', '1988'),
        ),
        'evaluations' => array(
            array(0, 1, 4),
            array(0, 3, 5),
            array(0, 4, 3),
            array(1, 1, 3),
            array(2, 5, 4),
            array(2, 4, 5),
            array(3, 1, 5),
            array(3, 2, 2),
            array(3, 3, 5),
        ),

    );

    public function __call($name , array $arguments){

        if (strpos($name,"set") ===0){
            $variable = lcfirst(str_replace("set",'',$name));
            $this->$variable = $arguments[0];
        }
        else if (strpos($name,"get") ===0){
            $variable = lcfirst(str_replace("get",'',$name));
            return $this->$variable;
        }
    }

    /**
     * [load description]
     * @param  ObjectManager $manager [description]
     * @return [type]                 [description]
     */
    public function load(ObjectManager $manager)
    {
        $this->getDemoFixtures();
        $this->masterLoad(); 
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

    protected function masterLoad()
    {
        $this->loading = true;

        foreach ($this->getDemoFixtures() as $name => $data) {
            $class = 'demo' . ucfirst($name) . 'Data';
            $this->setNewEntityObject($class);
            $this->setCurrentFixturesList($data);
            $this->funkyLoad($manager);
        }

        unset($this->loading);
    }

    protected function funkyLoad(ObjectManager $manager)
    {
        foreach ($this->getCurrentFixturesList() as $row) {
            $newFObject = $this->getNewEntityObject();

            $i = 0;
            foreach ($this->getHeader as $key => $attr) {
                if (!is_numeric($key)) {
                    $type = $attr;
                    $attr = $key;
                } else {
                    $type = 'string';
                }

                $setter = 'set' . ucfirst($attr);
                $typeSetter = $setter . 'Type';

                switch (true) {
                    case (method_exists(object, $typeSetter)):
                        $newFObject->$typeSetter($row[$i]);
                        break;
                    default:
                        $this->setVar($attr, $row[$i]);
                        break;
                }
            }

            $manager->persist($newFObject);
            $manager->flush();

            unset($newFObject);
        }
    }

    public function getHeader()
    {
        if (!isSetHeader()) {
            $this->declareHeader();
        }
        
        return $this->header;
    }

    protected function setVar($var, $value)
    {
        switch (true) {
            case (method_exists($this, 'set' . ucfirst($var))):
                call_user_func_array(array($this, 'set' . ucfirst($var)), array($value));
                break;
            default:
                $this->{$var} = $value;
                break;
        }
    }

}