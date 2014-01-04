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

namespace Cyclogram;

use Symfony\Component\HttpFoundation\Session;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Security\Core\SecurityContext;

class CyclogramCommon {
    
    private $container;
    
    public function __construct (Container $container)
    {
        $this->container = $container;
    }

    public static function  getAutoGeneratedCode($random_string_length=1)
    {
        //$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $characters = '0123456789';
        $string = '';

        for ($i = 0; $i < $random_string_length; $i++) {
            $string .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $string;
    }

    public static function generateParticipantCampaignLinkID($participant_level, $participant_id, $campaign_id, $participant_count)
    {
        $id = '';
        $number_of_rows = ($participant_count == 0) ? 0 : ($participant_count+1);
        $id = dechex($participant_level) . dechex($participant_id) . dechex($campaign_id) . dechex($number_of_rows);
        //@TODO: 
        //@TODO: This feature is now new in JP's code
        /*
         * select CONCAT(hex('2'),hex('1'),hex('1'),hex(COUNT(_num_of_rows_with_the_same_hex));
         */
        return $id;
    }

    public static function getRandomPicNumber($last, $new){

        if( $last == $new ){
            if( $last != 1 ){
                $new--;
            }else {
                $new = 1;
            }
        }
        return $new;
    }
    
    public static function generateGoogleShorURL($longUrl) {
    	
    	//This is the URL you want to shorten
    	$apiKey = 'AIzaSyAJBstlR9q8hU87tiy5v1x4XvSap3G1zm0';
    	//Get API key from : http://code.google.com/apis/console/
    	
    	$postData = array('longUrl' => $longUrl, 'key' => $apiKey);
    	$jsonData = json_encode($postData);
    	
    	$curlObj = curl_init();
    	
    	curl_setopt($curlObj, CURLOPT_URL, 'https://www.googleapis.com/urlshortener/v1/url');
    	curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
    	curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, 0);
    	curl_setopt($curlObj, CURLOPT_HEADER, 0);
    	curl_setopt($curlObj, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
    	curl_setopt($curlObj, CURLOPT_POST, 1);
    	curl_setopt($curlObj, CURLOPT_POSTFIELDS, $jsonData);
    	
    	$response = curl_exec($curlObj);
    	
    	//change the response json string to object
    	$json = json_decode($response);
    	
    	curl_close($curlObj);
    	
    	return $json->id;
    } 
    
    public static function encode($str, $key) {
		//@TODO: To implement
    	return base64_encode(base64_encode($str));     	
    }
    
    public static function decode($str, $key) {
    	//@TODO: To implement
    	
    	return base64_decode(base64_decode($str));
    }
    
    public static function from_camel_case($str) {
    	$str[0] = strtolower($str[0]);
    	$func = create_function('$c', 'return "_" . strtolower($c[1]);');
    	return preg_replace_callback('/([A-Z])/', $func, $str);
    }
    
    /**
     * Translates a string with underscores into camel case (e.g. first_name -&gt; firstName)
     * @param    string   $str                     String in underscore format
     * @param    bool     $capitalise_first_char   If true, capitalise the first char in $str
     * @return   string                              $str translated into camel caps
     */
    public static function to_camel_case($str, $capitalise_first_char = false) {
    	if($capitalise_first_char) {
    		$str[0] = strtoupper($str[0]);
    	}
    	$func = create_function('$c', 'return strtoupper($c[1]);');
    	return preg_replace_callback('/_([a-z])/', $func, $str);
    }

    public static function underscoreToCamelCase($string, $capitalizeFirstCharacter = false, $returnWithSpaces = false)
    {
    
    	if($returnWithSpaces) $str = str_replace(' ', ' ', ucwords(str_replace('_', ' ', $string)));
		else $str = str_replace(' ', '', ucwords(str_replace('_', ' ', $string)));
    
    	if (!$capitalizeFirstCharacter) {
    		$str[0] = strtolower($str[0]);
    	}
    
    	return $str;
    }
    
    
    public function checkAuthentication($role, $controller, $action)
    {
    
    	//@TODO: Implement the following
    	/*
    	* here is common method
    	*
    	* role = ROLE_STUDY_COORDINATOR
    	*
    	* if (false === $this->get('security.context')->isGranted($role)) {
    	*   $this->get('custom_db')->getFactory('CommonCustom')->addEvent($user->getUserId(),null,1,"$controller:$action",'no authorization');
    	*   return $this->redirect($this->generateUrl("no_authorization"));
    	* }else $this->get('custom_db')->getFactory('CommonCustom')->addEvent($user->getUserId(),null,1,"$controller:$action",'success');
    	*
    	*/
    	 
    	}
    
    public function format($date, $detailed = false)
    {
    	if (!empty($date)) {
    		if ($date instanceof \DateTime) {
    			if ($detailed === true) {
    				return $date->format($this->getOption('detailed_format'));
    			} else {
    				return $date->format($this->getOption('default_format'));
    			}
    		}
    	}
    
    	return null;
    	}
    
    protected function getOption($name)
    {
    	if (array_key_exists($name, $this->options)) {
    		return $this->options[$name];
    	}
    
    throw new Exception('Options does not exist');
    }
    
    function mb_str_pad($input, $pad_length, $pad_string=' ', $pad_type=STR_PAD_BOTH) {
    	$diff = strlen($input) - mb_strlen($input);
    	return str_pad($input, $pad_length+$diff, $pad_string, $pad_type);
    }
    
    /*
     * return the current namespace, bundle, controller and action
     */
    public static function whereAmI($controller, $param = null)
    {
    	 
    	$matches    = array();
    	preg_match('/(.*)\\\Bundle\\\(.*)\\\Controller\\\(.*)Controller::(.*)Action/', $controller, $matches);
    	 
    	$request = array();
    	$request['namespace'] = $matches[1];
    	$request['bundle'] = $matches[2];
    	$request['controller'] = $matches[3];
    	$request['action'] = $matches[4];
    	
    	if($param) return $matches[$param];
    	else return $request;
    }
    
    public function sendMail($from = null, $to, $subject, $body, $attachment = null, $embedded = null, $renderTemplate = false, $renderParams = null) 
    {
        $result = null;
        //verify emails
//         $verify = $this->verifyEmail($to);
//         if ($verify['status'] == false)
//             return $result = array('status' => false, 'message' =>  $verify['message']);
        
//         if (!is_null($from)) {
//             $verify = $this->verifyEmail($from);
//             if ($verify['status'] == false)
//                 return $result = array('status' => false, 'message' =>  $verify['message']);
//         }
        //do not send emails in production
        if($this->container->get('kernel')->getEnvironment() == "prod"){
            $result['status'] = true;
            return $result;
        }
        
//         $control_mail = $this->container->getParameter('control_mail');
        $templating = $this->container->get('templating');
        
        $message = \Swift_Message::newInstance()
        ->setContentType('text/html');
        if (is_null($from))
            $message->setFrom($this->container->getParameter('mailer_from'), $this->container->getParameter('mailer_envelope_from'))->setTo($to);
        else
            $message->setFrom($from)->setTo($to);
//         ->addBcc($control_mail);
        $message->setSender('crew@cyclogram.com');
        if($subject)
            $message->setSubject($subject);
        
        if ($attachment) {
            if (is_array($attachment)) {
                foreach ($attachment as $file) {
                    $message->attach(\Swift_Attachment::fromPath($file));
                }
            } else {
                $message->attach(\Swift_Attachment::fromPath($attachment));
            }
        }
        
        if ($embedded) {
            foreach ($embedded as $name => $file) {
                $renderParams['images'][$name] = $message->embed(\Swift_EmbeddedFile::fromPath($file));
            }
        }
        
        if ($renderTemplate) {
        
            if($templating->exists($body)) {
                $message->setBody($templating->render($body, $renderParams));
            } else {

        
            }

        } else {
            $message->setBody($body);
        }
        
        try {
            $this->container->get('mailer')->send($message);
        } catch (\Swift_TransportException $exc) {
             return $result = array('status' => false, 'message' => $this->container->get('translator')->trans('email_not_send_try_later', array(), 'validators'));
        }
        $result['status'] = true;
        return $result;
    }
    
    public static function parsePhoneNumber($phone){
        //TODO:support all country codes - requires some good parsing logic
        $full_phone = array();
        if(substr($phone, 0 , 1) == '1'){
            $full_phone['country_code'] = substr($phone, 0 , 1);
            $full_phone['phone'] = substr($phone, 1);
        }
        if (substr($phone, 0 , 3) == '380') {
            $full_phone['country_code'] = substr($phone, 0 , 3);
            $full_phone['phone'] = substr($phone, 3);
        }
        if (substr($phone, 0 , 3) == '506') {
            $full_phone['country_code'] = substr($phone, 0 , 3);
            $full_phone['phone'] = substr($phone, 3);
        }
        return $full_phone;
    }
    
    public function getEmbeddedImages() {
        $branding = $this->container->getParameter('branding');
        if ($branding == 'knowathome') {
            $embedded['logo_knowathome'] = realpath($this->container->getParameter('kernel.root_dir') . "/../web/branding/knowathome/logo.png");
        } else {
            $embedded['logo_top'] = realpath($this->container->getParameter('kernel.root_dir') . "/../web/images/logo.jpg");
            $embedded['logo_footer'] = realpath($this->container->getParameter('kernel.root_dir') . "/../web/images/newletter_logo_footer.png");
        }
        //            $embedded['login_button'] = realpath($this->container->getParameter('kernel.root_dir') . "/../web/images/newsletter_small_login.jpg");
        //$embedded['white_top'] = realpath($this->container->getParameter('kernel.root_dir') . "/../web/images/newsletter_white_top.png");
        //$embedded['white_bottom'] = realpath($this->container->getParameter('kernel.root_dir') . "/../web/images/newsletter_white_bottom.png");
        $embedded['login'] = realpath($this->container->getParameter('kernel.root_dir') . "/../web/images/login.jpg");
        //$embedded['arrow'] = realpath($this->container->getParameter('kernel.root_dir') . "/../web/images/arrow.jpg");
        $embedded['tmp_logo'] = realpath($this->container->getParameter('kernel.root_dir') . "/../web/images/tmplogo_none.jpg");
        
        return $embedded;
    }
    
    public function verifyEmail($email) {
        
        $username = $this->container->getParameter('email_verifier_username');
        $password = $this->container->getParameter('email_verifier_password');
        
        if (is_array($email)) {
            foreach ($email as $m) {
                $url = $this->container->getParameter('email_verifier_url').'usr='.$username.'&pwd='.$password.'&check='.$m;
                $api_response = json_decode($this->curl_get_contents($url));
                if (!$api_response->verify_status)
                   return array('status' => false, 'message' => $m . ' : '. $this->container->get('translator')->trans('email_not_valid', array(), 'validators'));
            }
        } else {
            $url = $this->container->getParameter('email_verifier_url').'usr='.$username.'&pwd='.$password.'&check='.$email;
            $api_response = json_decode($this->curl_get_contents($url));
            if (!$api_response->verify_status)
                return array('status' => false, 'message' => $email . ' : '. $this->container->get('translator')->trans('email_not_valid', array(), 'validators'));
        }
        return array('status' => true);
    }
    
    // Get remote file contents from verifier API
    private function curl_get_contents($url)
    {
        // Initiate the curl session
        $ch = curl_init();
    
        // Set the URL
        curl_setopt($ch, CURLOPT_URL, $url);
    
        // Removes the headers from the output
        curl_setopt($ch, CURLOPT_HEADER, 0);
    
        // Return the output instead of displaying it directly
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    
        // Execute the curl session
        $output = curl_exec($ch);
    
        // Close the curl session
        curl_close($ch);
    
        // Return the output as a variable
        return $output;
    }

}