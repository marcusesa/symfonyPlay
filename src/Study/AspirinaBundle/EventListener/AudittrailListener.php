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
            $r = $this->getEntityColumnValues($entity, $em);
            var_dump($r);
            die;
            
        }

        foreach ($uow->getScheduledEntityUpdates() as $entity) {
            var_dump($entity->getId());
            var_dump($uow->getEntityChangeSet($entity));
            die;
        }

        foreach ($uow->getScheduledEntityDeletions() as $entity) {
            $r = $this->getEntityColumnValues($entity, $em);
            var_dump($r);
            die;
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