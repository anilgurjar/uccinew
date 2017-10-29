<?php
namespace App\Model\Entity;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property int $company_id
 * @property string $member_name
 * @property string $member_nominee_type
 * @property string $email_id
 * @property string $username
 * @property string $password
 * @property string $mobile_no
 * @property int $id_card_email
 * @property string $passkey
 * @property int $timeout
 * @property int $member_flag
 * @property string $facebook_account
 * @property string $gmail_account
 * @property string $device_token
 * @property string $member_designation
 * @property string $social_id
 * @property string $login_by
 * @property string $fb_user_id
 * @property string $fb_token
 * @property string $google_token
 * @property string $google_auth
 * @property string $image
 *
 * @property \App\Model\Entity\Election $election
 * @property \App\Model\Entity\Role $role
 * @property \App\Model\Entity\MemberFee[] $member_fees
 * @property \App\Model\Entity\MemberReceipt $member_receipt
 * @property \App\Model\Entity\Module $module
 * @property \App\Model\Entity\UserRight $user_right
 * @property \App\Model\Entity\MasterTurnOver $master_turn_over
 * @property \App\Model\Entity\MasterMemberType $master_member_type
 * @property \App\Model\Entity\MasterGrade $master_grade
 * @property \App\Model\Entity\MasterCategory $master_category
 * @property \App\Model\Entity\MasterClassification $master_classification
 * @property \App\Model\Entity\MasterTaxation $master_taxation
 * @property \App\Model\Entity\MasterTaxationRate $master_taxation_rate
 * @property \App\Model\Entity\MasterMembershipFee $master_membership_fee
 * @property \App\Model\Entity\CertificateOrigin $certificate_origin
 * @property \App\Model\Entity\MemberFeeTaxAmount $member_fee_tax_amount
 * @property \App\Model\Entity\MasterCompany $master_company
 * @property \App\Model\Entity\BankDetail $bank_detail
 * @property \App\Model\Entity\Blog[] $blogs
 * @property \App\Model\Entity\Event $event
 * @property \App\Model\Entity\GalleryPhoto $gallery_photo
 * @property \App\Model\Entity\Initiative $initiative
 * @property \App\Model\Entity\Gallery $gallery
 * @property \App\Model\Entity\Advertisement $advertisement
 * @property \App\Model\Entity\AffilationRegistration $affilation_registration
 * @property \App\Model\Entity\HomeMenu $home_menu
 * @property \App\Model\Entity\CompanyMaster $company_master
 * @property \App\Model\Entity\MembershipDueAmount[] $membership_due_amounts
 */
class User extends Entity
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
        '*' => true
    ];
    protected function _setPassword($password)
    {
        $hasher = new DefaultPasswordHasher();
        return $hasher->hash($password);
    }
	protected $_virtual = [
        'members_image'
    ];
	
	protected function _getMembersImage()
    {
		if(!empty($this->_properties['image']))
		{
			return 'http://app.ucciudaipur.in/webroot/'.$this->_properties['image'];
		}
		else
		{ return "";}
    }
    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
   
}
