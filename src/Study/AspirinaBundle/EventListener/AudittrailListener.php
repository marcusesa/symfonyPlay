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

        }

        foreach ($uow->getScheduledEntityUpdates() as $entity) {
            var_dump($entity->getId());
            var_dump($uow->getEntityChangeSet($entity));
            die;
        }

        foreach ($uow->getScheduledEntityDeletions() as $entity) {
            $idEntity = $entity->getId();
            $repository = $em->getRepository(get_class($entity));
            $r = $repository->findOneById($idEntity);
            $r = $entity;
            var_dump($r);
            die;
        }

        
        
        foreach ($uow->getScheduledCollectionDeletions() as $col) {

        }

        foreach ($uow->getScheduledCollectionUpdates() as $col) {

        }
    }
}