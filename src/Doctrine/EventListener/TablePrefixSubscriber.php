<?php

namespace App\Doctrine\EventListener;

use Doctrine\ORM\Events;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Mapping\ClassMetadataInfo;
use Doctrine\ORM\Event\LoadClassMetadataEventArgs;

class TablePrefixSubscriber implements EventSubscriber
{
    private $prefix;

    public function __construct(string $prefix = 'tb_')
    {
        $this->prefix = $prefix;
    }

    public function getSubscribedEvents()
    {
        return [Events::loadClassMetadata];
    }

    public function loadClassMetadata(LoadClassMetadataEventArgs $event)
    {
        $classMetadata = $event->getClassMetadata();

        if (!$classMetadata->isInheritanceTypeSingleTable() ||
            $classMetadata->getName() === $classMetadata->rootEntityName) {
            $classMetadata->setPrimaryTable([
                'name' => $this->prefix.$classMetadata->getTableName(),
            ]);
        }

        foreach ($classMetadata->getAssociationMappings() as $fieldName => $mapping) {
            if (ClassMetadataInfo::MANY_TO_MANY === $mapping['type'] && $mapping['isOwningSide']) {
                $mappedTableName = $this->prefix.$mapping['joinTable']['name'];
                $classMetadata->associationMappings[$fieldName]['joinTable']['name'] = $mappedTableName;
            }
        }
    }
}
