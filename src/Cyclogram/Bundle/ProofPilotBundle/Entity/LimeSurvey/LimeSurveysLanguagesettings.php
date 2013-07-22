<?php

namespace Cyclogram\Bundle\ProofPilotBundle\Entity\LimeSurvey;
use Doctrine\ORM\Mapping as ORM;

/**
 * LimeSurveysLanguagesettings
 *
 * @ORM\Table(name="lime_surveys_languagesettings")
 * @ORM\Entity
 */
class LimeSurveysLanguagesettings
{
    /**
     * @var integer
     *
     * @ORM\Column(name="surveyls_survey_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $surveylsSurveyId;

    /**
     * @var string
     *
     * @ORM\Column(name="surveyls_language", type="string", length=45, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $surveylsLanguage;

    /**
     * @var string
     *
     * @ORM\Column(name="surveyls_title", type="string", length=200, nullable=false)
     */
    private $surveylsTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="surveyls_description", type="text", nullable=true)
     */
    private $surveylsDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="surveyls_welcometext", type="text", nullable=true)
     */
    private $surveylsWelcometext;

    /**
     * @var string
     *
     * @ORM\Column(name="surveyls_endtext", type="text", nullable=true)
     */
    private $surveylsEndtext;

    /**
     * @var string
     *
     * @ORM\Column(name="surveyls_url", type="string", length=255, nullable=true)
     */
    private $surveylsUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="surveyls_urldescription", type="string", length=255, nullable=true)
     */
    private $surveylsUrldescription;

    /**
     * @var string
     *
     * @ORM\Column(name="surveyls_email_invite_subj", type="string", length=255, nullable=true)
     */
    private $surveylsEmailInviteSubj;

    /**
     * @var string
     *
     * @ORM\Column(name="surveyls_email_invite", type="text", nullable=true)
     */
    private $surveylsEmailInvite;

    /**
     * @var string
     *
     * @ORM\Column(name="surveyls_email_remind_subj", type="string", length=255, nullable=true)
     */
    private $surveylsEmailRemindSubj;

    /**
     * @var string
     *
     * @ORM\Column(name="surveyls_email_remind", type="text", nullable=true)
     */
    private $surveylsEmailRemind;

    /**
     * @var string
     *
     * @ORM\Column(name="surveyls_email_register_subj", type="string", length=255, nullable=true)
     */
    private $surveylsEmailRegisterSubj;

    /**
     * @var string
     *
     * @ORM\Column(name="surveyls_email_register", type="text", nullable=true)
     */
    private $surveylsEmailRegister;

    /**
     * @var string
     *
     * @ORM\Column(name="surveyls_email_confirm_subj", type="string", length=255, nullable=true)
     */
    private $surveylsEmailConfirmSubj;

    /**
     * @var string
     *
     * @ORM\Column(name="surveyls_email_confirm", type="text", nullable=true)
     */
    private $surveylsEmailConfirm;

    /**
     * @var integer
     *
     * @ORM\Column(name="surveyls_dateformat", type="integer", nullable=false)
     */
    private $surveylsDateformat;

    /**
     * @var string
     *
     * @ORM\Column(name="email_admin_notification_subj", type="string", length=255, nullable=true)
     */
    private $emailAdminNotificationSubj;

    /**
     * @var string
     *
     * @ORM\Column(name="email_admin_notification", type="text", nullable=true)
     */
    private $emailAdminNotification;

    /**
     * @var string
     *
     * @ORM\Column(name="email_admin_responses_subj", type="string", length=255, nullable=true)
     */
    private $emailAdminResponsesSubj;

    /**
     * @var string
     *
     * @ORM\Column(name="email_admin_responses", type="text", nullable=true)
     */
    private $emailAdminResponses;

    /**
     * @var integer
     *
     * @ORM\Column(name="surveyls_numberformat", type="integer", nullable=false)
     */
    private $surveylsNumberformat;

    /**
     * @var string
     *
     * @ORM\Column(name="surveyls_attributecaptions", type="text", nullable=true)
     */
    private $surveylsAttributecaptions;

    public function getSurveylsSurveyId()
    {
        return $this->surveylsSurveyId;
    }

    public function setSurveylsSurveyId($surveylsSurveyId)
    {
        $this->surveylsSurveyId = $surveylsSurveyId;
    }

    public function getSurveylsLanguage()
    {
        return $this->surveylsLanguage;
    }

    public function setSurveylsLanguage($surveylsLanguage)
    {
        $this->surveylsLanguage = $surveylsLanguage;
    }

    public function getSurveylsTitle()
    {
        return $this->surveylsTitle;
    }

    public function setSurveylsTitle($surveylsTitle)
    {
        $this->surveylsTitle = $surveylsTitle;
    }

    public function getSurveylsDescription()
    {
        return $this->surveylsDescription;
    }

    public function setSurveylsDescription($surveylsDescription)
    {
        $this->surveylsDescription = $surveylsDescription;
    }

    public function getSurveylsWelcometext()
    {
        return $this->surveylsWelcometext;
    }

    public function setSurveylsWelcometext($surveylsWelcometext)
    {
        $this->surveylsWelcometext = $surveylsWelcometext;
    }

    public function getSurveylsEndtext()
    {
        return $this->surveylsEndtext;
    }

    public function setSurveylsEndtext($surveylsEndtext)
    {
        $this->surveylsEndtext = $surveylsEndtext;
    }

    public function getSurveylsUrl()
    {
        return $this->surveylsUrl;
    }

    public function setSurveylsUrl($surveylsUrl)
    {
        $this->surveylsUrl = $surveylsUrl;
    }

    public function getSurveylsUrldescription()
    {
        return $this->surveylsUrldescription;
    }

    public function setSurveylsUrldescription($surveylsUrldescription)
    {
        $this->surveylsUrldescription = $surveylsUrldescription;
    }

    public function getSurveylsEmailInviteSubj()
    {
        return $this->surveylsEmailInviteSubj;
    }

    public function setSurveylsEmailInviteSubj($surveylsEmailInviteSubj)
    {
        $this->surveylsEmailInviteSubj = $surveylsEmailInviteSubj;
    }

    public function getSurveylsEmailInvite()
    {
        return $this->surveylsEmailInvite;
    }

    public function setSurveylsEmailInvite($surveylsEmailInvite)
    {
        $this->surveylsEmailInvite = $surveylsEmailInvite;
    }

    public function getSurveylsEmailRemindSubj()
    {
        return $this->surveylsEmailRemindSubj;
    }

    public function setSurveylsEmailRemindSubj($surveylsEmailRemindSubj)
    {
        $this->surveylsEmailRemindSubj = $surveylsEmailRemindSubj;
    }

    public function getSurveylsEmailRemind()
    {
        return $this->surveylsEmailRemind;
    }

    public function setSurveylsEmailRemind($surveylsEmailRemind)
    {
        $this->surveylsEmailRemind = $surveylsEmailRemind;
    }

    public function getSurveylsEmailRegisterSubj()
    {
        return $this->surveylsEmailRegisterSubj;
    }

    public function setSurveylsEmailRegisterSubj(
            $surveylsEmailRegisterSubj)
    {
        $this->surveylsEmailRegisterSubj = $surveylsEmailRegisterSubj;
    }

    public function getSurveylsEmailRegister()
    {
        return $this->surveylsEmailRegister;
    }

    public function setSurveylsEmailRegister($surveylsEmailRegister)
    {
        $this->surveylsEmailRegister = $surveylsEmailRegister;
    }

    public function getSurveylsEmailConfirmSubj()
    {
        return $this->surveylsEmailConfirmSubj;
    }

    public function setSurveylsEmailConfirmSubj(
            $surveylsEmailConfirmSubj)
    {
        $this->surveylsEmailConfirmSubj = $surveylsEmailConfirmSubj;
    }

    public function getSurveylsEmailConfirm()
    {
        return $this->surveylsEmailConfirm;
    }

    public function setSurveylsEmailConfirm($surveylsEmailConfirm)
    {
        $this->surveylsEmailConfirm = $surveylsEmailConfirm;
    }

    public function getSurveylsDateformat()
    {
        return $this->surveylsDateformat;
    }

    public function setSurveylsDateformat($surveylsDateformat)
    {
        $this->surveylsDateformat = $surveylsDateformat;
    }

    public function getEmailAdminNotificationSubj()
    {
        return $this->emailAdminNotificationSubj;
    }

    public function setEmailAdminNotificationSubj(
            $emailAdminNotificationSubj)
    {
        $this->emailAdminNotificationSubj = $emailAdminNotificationSubj;
    }

    public function getEmailAdminNotification()
    {
        return $this->emailAdminNotification;
    }

    public function setEmailAdminNotification($emailAdminNotification)
    {
        $this->emailAdminNotification = $emailAdminNotification;
    }

    public function getEmailAdminResponsesSubj()
    {
        return $this->emailAdminResponsesSubj;
    }

    public function setEmailAdminResponsesSubj($emailAdminResponsesSubj)
    {
        $this->emailAdminResponsesSubj = $emailAdminResponsesSubj;
    }

    public function getEmailAdminResponses()
    {
        return $this->emailAdminResponses;
    }

    public function setEmailAdminResponses($emailAdminResponses)
    {
        $this->emailAdminResponses = $emailAdminResponses;
    }

    public function getSurveylsNumberformat()
    {
        return $this->surveylsNumberformat;
    }

    public function setSurveylsNumberformat($surveylsNumberformat)
    {
        $this->surveylsNumberformat = $surveylsNumberformat;
    }

    public function getSurveylsAttributecaptions()
    {
        return $this->surveylsAttributecaptions;
    }

    public function setSurveylsAttributecaptions(
             $surveylsAttributecaptions)
    {
        $this->surveylsAttributecaptions = $surveylsAttributecaptions;
    }

}
