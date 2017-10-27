<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * IndustrialGrievance Entity
 *
 * @property int $id
 * @property int $grievance_number
 * @property int $grievance_category_id
 * @property int $industrial_department_id
 * @property int $grievance_issue_id
 * @property string $lodge_same_grievance
 * @property string $grievance_period
 * @property int $grievance_age
 * @property string $document
 * @property int $grievance_issue_related_id
 * @property string $description
 * @property string $location
 * @property \Cake\I18n\Time $created_on
 * @property int $created_by
 * @property int $mail_status
 * @property string $complete_status
 * @property string $comment
 * @property \Cake\I18n\Time $close_date
 * @property string $reopen_reason
 * @property string $grievance_pdf
 *
 * @property \App\Model\Entity\GrievanceCategory $grievance_category
 * @property \App\Model\Entity\IndustrialDepartment $industrial_department
 * @property \App\Model\Entity\GrievanceIssue $grievance_issue
 * @property \App\Model\Entity\GrievanceIssueRelated $grievance_issue_related
 * @property \App\Model\Entity\IndustrialGrievanceFollow[] $industrial_grievance_follows
 * @property \App\Model\Entity\IndustrialGrievanceStatus[] $industrial_grievance_statuses
 * @property \App\Model\Entity\User $user
 */
class IndustrialGrievance extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
	protected $_virtual = [
        'document_fullpath','pdf_fullpath'
    ];
	protected function _getDocumentFullpath()
    {
		if($this->_properties['document'])
		{
			return 'http://app.ucciudaipur.in/webroot/'.$this->_properties['document'];
		}
		else{return "";}
    }
	protected function _getPdfFullpath()
    {
		if($this->_properties['grievance_pdf'])
		{
			return 'http://app.ucciudaipur.in/webroot/'.$this->_properties['grievance_pdf'];
		}
		else{return "";}
    }
}
