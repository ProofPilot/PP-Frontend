<?php
namespace Cyclogram\Bundle\ProofPilotBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class ParticipantRepository extends EntityRepository implements
        UserProviderInterface
{

    public function loadUserByUsername($username)
    {
        return $this->getEntityManager()
         ->createQuery('SELECT p FROM
         CyclogramProofPilotBundle:Participant p
         WHERE p.participantEmail = :username
         OR p.participantUsername = :username')
         ->setParameters(array(
                       'username' => $username
                        ))
         ->getOneOrNullResult();

    }
    public function refreshUser(UserInterface $user)
    {
        return $this->loadUserByUsername($user->getUsername());

    }
    public function supportsClass($class)
    {
        return $class === 'Cyclogram\Bundle\ProofPilotBundle\Entity\Participant';
    }
    
    public function getParticipantInterventions($userid){
        return $this->getEntityManager()
        ->createQuery('SELECT COUNT (pi) FROM CyclogramProofPilotBundle:ParticipantInterventionLink pi
                WHERE pi.participant = :userid')
        ->setParameters(array(
                        'userid' => $userid))
        ->getSingleScalarResult();
    }

}
