<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Employee Entity
 *
 * @property int $id
 * @property string $number
 * @property string $civilitie_id
 * @property string $last_name
 * @property string $first_name
 * @property int $language_id
 * @property string $cell_number
 * @property string $email
 * @property int $position_title_id
 * @property int $building_id
 * @property int $parent_id
 * @property string $additional_Infos
 * @property \Cake\I18n\FrozenTime $last_sent_formation_plan
 * @property bool $active
 *
 * @property \App\Model\Entity\Civility $civility
 * @property \App\Model\Entity\Language $language
 * @property \App\Model\Entity\PositionTitle $position_title
 * @property \App\Model\Entity\Building $building
 * @property \App\Model\Entity\Employee $parent_employee
 * @property \App\Model\Entity\Employee[] $child_employees
 */
class Employee extends Entity
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
    
    protected function _getFullName()
    {
        return $this->_properties['first_name'] . ' ' . $this->_properties['last_name'];
    }
}
