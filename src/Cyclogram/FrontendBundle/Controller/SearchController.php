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

namespace Cyclogram\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpFoundation\Request;
use Cyclogram\CyclogramCommon;
use Symfony\Component\HttpFoundation\Response;

class SearchController extends Controller
{
    /**
     * @Route("/get_city_state_ajax/{zipcode}", name="_get_city_state_by_zip", options={"expose"=true})
     */
    public function getCityAndStateByZipCode($zipcode)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $results = $em->createQuery("
                SELECT c.cityId, c.cityName, s.stateId, s.stateCode
                FROM CyclogramProofPilotBundle:City c
                INNER JOIN c.state s
                WHERE c.cityZipcode = :zipcode
                ")
                ->setParameter('zipcode', $zipcode)
                ->getResult();
    
        //         foreach($results as $result ) {
        //             $json[] = array (
        //                     'cityId' => $result["cityId"],
        //                     'cityName' => $result["cityName"],
        //                     'stateId' => $result["stateId"],
        //                     'stateName' => $result["stateName"]
        //                     );
        //         }
        return new Response(json_encode($results));
    
    }
    
    
    /**
     * @Route("/search_city_ajax", name="searchCityWithAjax", options={"expose"=true})
     */
    public function searchCityWithAjaxAction(Request $request)
    {
        if ($term = trim($request->get('query')))
        {
            $termUpper = strtoupper($term);
            $em = $this->getDoctrine()->getEntityManager();
    
            $repository = $this->getDoctrine()->getRepository('CyclogramProofPilotBundle:City');
    
            $qb = $repository->createQueryBuilder('c');
            $query = $qb
            ->select('c.cityName, c.cityId')
            ->where("UPPER(c.cityName) like '%$termUpper%'")
            ->getQuery();
    
            $cities = $query->getResult();
    
            foreach($cities as $city) {
                $suggestions[] = array(
                        'value' => $city["cityName"],
                        'data' =>  $city["cityId"]
                );
            }
    
            $json = array(
                    'query' => $term,
                    'suggestions' => $suggestions
            );
    
            return new Response(json_encode($json), 200);
        }
    
        return new Response('', 200);
    }
    
    /**
     * @Route("/search_state_ajax", name="searchStateWithAjax", options={"expose"=true})
     */
    public function searchStateWithAjaxAction(Request $request)
    {
        if ($term = trim($request->get('query')))
        {
            $termUpper = strtoupper($term);
            $em = $this->getDoctrine()->getEntityManager();
    
            $repository = $this->getDoctrine()->getRepository('CyclogramProofPilotBundle:Site');
    
            $qb = $repository->createQueryBuilder('s');
            $query = $qb
            ->select('s.siteID, s.')
            ->where("UPPER(s.stateCode) like '%$termUpper%'")
            ->getQuery();
    
            $states = $query->getResult();
    
            foreach($states as $state) {
                $suggestions[] = array(
                        'value' => $state["stateCode"],
                        'data' =>  $state["stateId"]
                );
            }
    
            $json = array(
                    'query' => $term,
                    'suggestions' => $suggestions
            );
    
            return new Response(json_encode($json), 200);
        }
    
        return new Response('', 200);
    }
    
    /**
     * @Route("/search_currency_ajax", name="searchCurrencyWithAjax", options={"expose"=true})
     */
    public function searchCurrencyWithAjaxAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $data = $request->request->all();
            $country = $this->container->get('doctrine')->getRepository('CyclogramProofPilotBundle:Country')->findOneByCountryName($data['country']);
            
            return new Response(json_encode(array('success' => true, 'currencySymbol' => $country->getCurrency()->getCurrencySymbol())));
        }
    }
    
    /**
     * @Route("/search_organization_locations", name="searchOrganizationLocations", options={"expose"=true})
     */
    public function searchOrganizationLocationsAjaxAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $data = $request->request->all();
            $em = $this->getDoctrine()->getEntityManager();
            $organization = $em->getRepository('CyclogramProofPilotBundle:Organization')->findOneByOrganizationName($data['organization']);
            $conn = $this->container->get('database_connection');
            $rows = $conn->fetchAll('SELECT site_name,lat, lng, ( 3959 * acos( cos( radians(40) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(-80) ) + sin( radians(40) ) * sin( radians( lat ) ) ) ) AS distance  FROM site HAVING distance < 500 ORDER BY distance LIMIT 0 , 20;');
            

            
            return new Response(json_encode(array('success' => true, 'currencySymbol' => $country->getCurrency()->getCurrencySymbol())));
        }
    }
}
