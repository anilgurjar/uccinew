<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Company Entity
 *
 * @property int $id
 * @property int $role_id
 * @property string $gst_number
 * @property int $id_card_no
 * @property string $company_organisation
 * @property string $address
 * @property string $city
 * @property int $pincode
 * @property string $end_products_item_dealing_in
 * @property string $office_telephone
 * @property string $residential_telephone
 * @property string $company_email_id
 * @property int $grade
 * @property int $category
 * @property int $classification
 * @property \Cake\I18n\Time $year_of_joining
 * @property int $member_type_id
 * @property int $turn_over_id
 * @property float $due_amount
 * @property int $member_flag
 * @property string $website
 * @property string $tag
 * @property string $infrastructure
 * @property string $brief_description
 *
 * @property \App\Model\Entity\Role $role
 * @property \App\Model\Entity\CompanyEmail $company_email
 * @property \App\Model\Entity\MemberType $member_type
 * @property \App\Model\Entity\TurnOver $turn_over
 * @property \App\Model\Entity\BusinessVisa[] $business_visas
 * @property \App\Model\Entity\CertificateOrigin[] $certificate_origins
 * @property \App\Model\Entity\CompanyMemberType[] $company_member_types
 * @property \App\Model\Entity\MemberFee[] $member_fees
 * @property \App\Model\Entity\MemberReceipt[] $member_receipts
 * @property \App\Model\Entity\User[] $users
 */
class Company extends Entity
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
        'company_image_fullpath','cheque_date'
    ];
	
	protected function _getCompanyImageFullpath()
    {
		if(!empty($this->_properties['company_image'])){
		return 'http://app.ucciudaipur.in/webroot/'.$this->_properties['company_image'];
		}
 		else
		{ return "";}
    }
	
	protected function _getChequeDate()
    {
		if(!empty($this->_properties['cheque_date'])){
			return date("Y-m-d",strtotime($this->_properties['cheque_date']));
		}
 		else
		{ return "";}
    }
	
	
}
