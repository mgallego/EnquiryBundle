<?php

/*
 * This file is part of the BDKEnquiryBundle package.
 *
 * (c) Bodaclick S.L. <http://bodaclick.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BDK\EnquiryBundle\Model\Manager;

use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class EnquiryManager
 * @package BDK\EnquiryBundle\Model\Manager
 */
class EnquiryManager
{
    protected $om;
    protected $repository;
    protected $class;

    /**
     * @param ObjectManager $om
     * @param               $class
     */
    public function __construct(ObjectManager $om, $class)
    {
        $this->om = $om;
        $this->repository = $om->getRepository($class);

        $metadata = $om->getClassMetadata($class);
        $this->class = $metadata->name;
    }

    /**
     * @return \Doctrine\ODM\MongoDB\DocumentRepository
     */
    public function getRepository()
    {
        return $this->repository;
    }

    /**
     * @return mixed
     */
    public function create()
    {
        return new $this->class();
    }

    /**
     * @param      $element
     * @param bool $andFlush
     */
    public function update($element, $andFlush = true)
    {
        $this->om->persist($element);

        if (true === $andFlush) {
            $this->om->flush();
        }
    }

    /**
     * @param $element
     */
    public function remove($element, $andFlush = true)
    {
        $this->om->remove($element);

        if (true === $andFlush) {
            $this->om->flush();
        }
    }
}