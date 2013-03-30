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