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

namespace Cyclogram\Bundle\ProofPilotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * History
 *
 * @ORM\Table(name="history")
 * @ORM\Entity
 */
class History
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="table_name", type="string", length=100, nullable=false)
     */
    private $tableName;

    /**
     * @var string
     *
     * @ORM\Column(name="field_name", type="string", length=100, nullable=false)
     */
    private $fieldName;

    /**
     * @var integer
     *
     * @ORM\Column(name="row_id", type="bigint", nullable=true)
     */
    private $rowId;

    /**
     * @var string
     *
     * @ORM\Column(name="previous_value", type="string", length=2000, nullable=false)
     */
    private $previousValue;

    /**
     * @var string
     *
     * @ORM\Column(name="new_value", type="string", length=2000, nullable=false)
     */
    private $newValue;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="history_datetime", type="datetime", nullable=false)
     */
    private $historyDatetime;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set tableName
     *
     * @param string $tableName
     * @return History
     */
    public function setTableName($tableName)
    {
        $this->tableName = $tableName;
    
        return $this;
    }

    /**
     * Get tableName
     *
     * @return string 
     */
    public function getTableName()
    {
        return $this->tableName;
    }

    /**
     * Set fieldName
     *
     * @param string $fieldName
     * @return History
     */
    public function setFieldName($fieldName)
    {
        $this->fieldName = $fieldName;
    
        return $this;
    }

    /**
     * Get fieldName
     *
     * @return string 
     */
    public function getFieldName()
    {
        return $this->fieldName;
    }

    /**
     * Set rowId
     *
     * @param integer $rowId
     * @return History
     */
    public function setRowId($rowId)
    {
        $this->rowId = $rowId;
    
        return $this;
    }

    /**
     * Get rowId
     *
     * @return integer 
     */
    public function getRowId()
    {
        return $this->rowId;
    }

    /**
     * Set previousValue
     *
     * @param string $previousValue
     * @return History
     */
    public function setPreviousValue($previousValue)
    {
        $this->previousValue = $previousValue;
    
        return $this;
    }

    /**
     * Get previousValue
     *
     * @return string 
     */
    public function getPreviousValue()
    {
        return $this->previousValue;
    }

    /**
     * Set newValue
     *
     * @param string $newValue
     * @return History
     */
    public function setNewValue($newValue)
    {
        $this->newValue = $newValue;
    
        return $this;
    }

    /**
     * Get newValue
     *
     * @return string 
     */
    public function getNewValue()
    {
        return $this->newValue;
    }

    /**
     * Set historyDatetime
     *
     * @param \DateTime $historyDatetime
     * @return History
     */
    public function setHistoryDatetime($historyDatetime)
    {
        $this->historyDatetime = $historyDatetime;
    
        return $this;
    }

    /**
     * Get historyDatetime
     *
     * @return \DateTime 
     */
    public function getHistoryDatetime()
    {
        return $this->historyDatetime;
    }
}