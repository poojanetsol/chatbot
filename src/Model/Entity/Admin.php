<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;
/**
 * Admin Entity
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property int $role
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class Admin extends Entity
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

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
    
	protected function _setPassword($value) {
        return (new DefaultPasswordHasher)->hash($value);
    }
}
