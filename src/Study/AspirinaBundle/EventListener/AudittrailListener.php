<?php

namespace Study\AspirinaBundle\EventListener;

use Doctrine\ORM\Event\OnFlushEventArgs;

class AudittrailListener
{
    public function onFlush(OnFlushEventArgs $eventArgs)
    {
        $em = $eventArgs->getEntityManager();
        $uow = $em->getUnitOfWork();
        
        foreach ($uow->getScheduledEntityInsertions() as $entity) {
            
            $properties = array();

            foreach ($this->getPropertiesNames($entity) as $propertyName) {
                $propertyValue = $this->getPropertyValue($entity, $propertyName);
                $properties[$propertyName] = $propertyValue;
            }

            die(var_dump($properties));
            $this->getEntityColumnValues($entity, $em);            
        }

        foreach ($uow->getScheduledEntityUpdates() as $entity) {
            $entity->getId();
            $uow->getEntityChangeSet($entity);
        }

        foreach ($uow->getScheduledEntityDeletions() as $entity) {
            $this->getEntityColumnValues($entity, $em);
        }
        
        foreach ($uow->getScheduledCollectionDeletions() as $col) {

        }

        foreach ($uow->getScheduledCollectionUpdates() as $col) {

        }
    }

    private function getPropertiesNames($entity)
    {
        $reflectClass = new \ReflectionClass($entity);
        $properties = $reflectClass->getProperties(\ReflectionProperty::IS_PRIVATE);

        $propertiesNames = array();

        foreach ($properties as $property) {
            $propertiesNames[] = $property->getName();
        }

        return $propertiesNames;
    }

    private function getPropertyValue($entity, $propertyName)
    {
        $getter = 'get'.ucfirst($propertyName);
        return $entity->$getter();
    }
    
    private function getEntityColumnValues($entity,$em)
    {
        $cols = $em->getClassMetadata(get_class($entity))->getColumnNames();
        $values = array();
        foreach($cols as $col){
          $getter = 'get'.ucfirst($col);
          $values[$col] = $entity->$getter();
        }
        return $values;
    }
}