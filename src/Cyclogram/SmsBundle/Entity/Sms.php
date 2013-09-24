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

namespace Cyclogram\SmsBundle\Entity;

use Symfony\Component\Yaml\Yaml;

class Sms
{
    private $_token;
    private $_phoneNumber;
    private $_message;
    private $_url;
    private $_kernel;
    private $_tropoNumber;

    public function __construct( \Symfony\Component\HttpKernel\Kernel $kernel )
    {
        $this->_kernel    = $kernel;
    }

    public function sendSms()
    {

        try
        {
            $configYml = $this->_kernel->locateResource("@CyclogramSmsBundle/Resources/config/config.yml");
        }
        catch(\InvalidArgumentException $e)
        {
            return false;
        }
        catch(\RuntimeException $e)
        {
            return false;
        }

        $config = Yaml::parse($configYml);

        $this->setToken($config['sms']['token']);
        $this->setUrl($config['sms']['url']);

        if( (empty($this->_phoneNumber)) || (empty($this->_message)) )
            return false;

        $url = $this->getUrl();
        $url .= "?action=create&token=".$this->getToken();
        $url .= "&numberToDial=".$this->getPhoneNumber();
        $url .= "&msg=".$this->getMessage();

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,  $url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //This avoids SSL cert verification. USE THIS ONLY IN DEV
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $smsResponse = curl_exec ($ch);
        curl_close ($ch);

        return $smsResponse;
    }

    public function ReceiveSms()
    {
    
    	try
    	{
    		$configYml = $this->_kernel->locateResource("@CyclogramSmsBundle/Resources/config/config.yml");
    	}
    	catch(\InvalidArgumentException $e)
    	{
    		return false;
    	}
    	catch(\RuntimeException $e)
    	{
    		return false;
    	}
    
    	$config = Yaml::parse($configYml);
    
    	$this->setToken($config['sms']['token']);
    	$this->setUrl($config['sms']['url']);
    	$this->setTropoNumber($config['sms']['number']);
    	
//    	if( (empty($this->_tropoNumber)) || (empty($this->_message)) )
//    		return false;
    
    	//@TODO: Hacerlo bretear!
    	$url = $this->getUrl();
    	$url .= "?action=create&token=".$this->getToken();
    	$url .= "&numberToDial=".$this->getPhoneNumber();
    	$url .= "&msg=".$this->getMessage();
    
    	$ch = curl_init();
    	curl_setopt($ch, CURLOPT_URL,  $url);
    	curl_setopt($ch, CURLOPT_HTTPGET, true);
    
    	//This avoids SSL cert verification. USE THIS ONLY IN DEV
    	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    	$smsResponse = curl_exec ($ch);
    	curl_close ($ch);
    
    	return $smsResponse;
    }
    
    
    public function setToken($token=null)
    {
        $this->_token = $token;
    }

    public function getToken()
    {
        return $this->_token;
    }

    public function setPhoneNumber($phoneNumber=null)
    {
        $this->_phoneNumber = $phoneNumber;
    }

    public function getPhoneNumber()
    {
        return $this->_phoneNumber;
    }
    
    public function setTropoNumber($tropoNumber=null)
    {
    	$this->_tropoNumber = $tropoNumber;
    }
    
    public function getTropNumber()
    {
    	return $this->_tropoNumber;
    }

    public function setMessage($message=null)
    {
        $this->_message = $message;
        //$this->_message = $message . " code: ".$this->_generateCode(8);
        $this->_message = rawurlencode($this->_message);
    }

    public function getMessage()
    {
        return $this->_message;
    }

    public function getUrl()
    {
        return $this->_url;
    }

    public function setUrl($url=null)
    {
        $this->_url = $url;
    }

    public function _generateCode($random_string_length=1)
    {
        //$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $characters = '0123456789';
        $string = '';

        for ($i = 0; $i < $random_string_length; $i++) {
            $string .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $string;
    }
}