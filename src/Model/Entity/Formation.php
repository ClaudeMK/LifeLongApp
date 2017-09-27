<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Formation Entity
 *
 * @property int $id
 * @property string $number
 * @property string $title
 * @property int $categorie_id
 * @property int $frequencie_id
 * @property string $notif_start
 * @property int $modalitie_id
 * @property float $duration
 * @property string $note
 *
 * @property \App\Model\Entity\Category $category
 * @property \App\Model\Entity\Frequency $frequency
 * @property \App\Model\Entity\Modality $modality
 */
class Formation extends Entity
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
}
