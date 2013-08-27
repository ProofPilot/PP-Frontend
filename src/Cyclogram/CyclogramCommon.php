<?php

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
    
    public function sendMail($to, $subject, $body, $attachment = null, $embedded = null, $renderTemplate = false, $renderParams = null) {

//         $control_mail = $this->container->getParameter('control_mail');
        $templating = $this->container->get('templating');
        
        $message = \Swift_Message::newInstance()
        ->setContentType('text/html')
        ->setFrom($this->container->getParameter('mailer_from'))
        ->setTo($to);
//         ->addBcc($control_mail);
        
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
            return false;
        }
        
        return true;
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

}