<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\DataFixtures\ORM\LoadFixturesMaster;
use AppBundle\Entity\AgeRange;
use Doctrine\Common\Persistence\ObjectManager;

class LoadAgeRangeData extends LoadFixturesMaster
{
    protected $demoFixturesArray = array(
        array("0-12"),
        array("13-18"),
        array("19-29"),
        array("30-39"),
        array("40-49"),
        array("50-59"),
        array("60-69"),
        array("70 et plus"),
    );

    /**
     * [getNewEntityObject description]
     * @return [type] [description]
     */
    protected function getNewEntityObject()
    {
        return new AgeRange();
    }

    protected function declareHeader()
    {
        $this->header = array(
            'age',
        );
    }

    public function getOrder()
    {
        return 3;
    }
    

}