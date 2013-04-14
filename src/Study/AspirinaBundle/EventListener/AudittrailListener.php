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
                if($this->hasAuditTrailInProperty($entity, $propertyName)){
                    $propertyValue = $this->getPropertyValue($entity, $propertyName);
                    $properties[$propertyName] = $propertyValue;
                }
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
        $properties = $reflectClass->getProperties();
        
        $propertiesNames = array();

        foreach ($properties as $property) {
            $propertiesNames[] = $property->getName();
        }

        return $propertiesNames;
    }
    
    private function hasAuditTrailInProperty($entity, $propertyName)
    {
        $reflectClass = new \ReflectionClass($entity);        
        $reflectProperty = new \ReflectionProperty($reflectClass->getName(), $propertyName);
        
        if (strpos($reflectProperty->getDocComment(), '@Audittrail')) {
            return true;
        }
        return false;
    }

    private function getPropertyValue($entity, $propertyName)
    {
        $getter = 'get'.ucfirst($propertyName);
        return $entity->$getter();
    }
    
}