<?php

namespace Akeneo\Bundle\StorageUtilsBundle\Doctrine;

use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Util\ClassUtils;

/**
 * Detacher, detaches an object from its ObjectManager
 *
 * @author    Nicolas Dupont <nicolas@akeneo.com>
 * @copyright 2014 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class ObjectDetacher implements ObjectDetacherInterface
{
    /** @var ManagerRegistry */
    protected $managerRegistry;

    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        $this->managerRegistry = $registry;
    }

    /**
     * {@inheritdoc}
     */
    public function detach($object)
    {
        $objectManager = $this->getObjectManager($object);
        $objectManager->detach($object);
    }

    /**
     * @param object $object
     *
     * @return ObjectManager
     */
    protected function getObjectManager($object)
    {
        return $this->managerRegistry->getManagerForClass(ClassUtils::getClass($object));
    }
}
