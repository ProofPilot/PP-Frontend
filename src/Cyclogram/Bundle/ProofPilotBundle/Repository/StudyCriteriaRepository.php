<?php
/*
 * This is part of the ProofPilot package.
*
* (c)2012-2013 Cyclogram, Inc, West Hollywood, CA <crew@proofpilot.com>
* ALL RIGHTS RESERVED
*
* This software is provided by the copyright holders to Manila Consulting for use on the
* Center for Disease Control's Evaluation of Rapid HIV Self-Testing among MSM in High
* Prevalence Cities until 2016 or the project is completed.
*
* Any unauthorized use, modification or resale is not permitted without expressed permission
* from the copyright holders.
*
* KnowatHome branding, URL, study logic, survey instruments, and resulting data are not part
* of this copyright and remain the property of the prime contractor.
*
*/
namespace Cyclogram\Bundle\ProofPilotBundle\Repository;

use Doctrine\ORM\EntityRepository;

class StudyCriteriaRepository  extends EntityRepository
{

    
    public function getCriteriaJson($studyCode) {

        $result = $query = $this->getEntityManager()
                ->createQuery(" SELECT sc.studyCriteriaJson
                                FROM CyclogramProofPilotBundle:StudyCriteria sc
                                INNER JOIN sc.study s 
                                WHERE
                                    s.studyCode = :studycode")
                 ->setParameters(array('studycode' => $studyCode))
                 ->getResult();
//        $result = $query = $this->getEntityManager()
//         ->createQuery("
//                 SELECT cast(sc.studyCriteriaJson AS STRING)
//                 FROM CyclogramProofPilotBundle:StudyCriteria sc
//                 INNER JOIN sc.study s
//                 WHERE
//                     s.studyCode = :studycode
                    

//                 ")
//                 ->setParameters(array(
//                         'studycode' => $studyCode,
//                 ))->getResult();
       
       if ($result) return $result[0]['studyCriteriaJson'];

    }
    
}
