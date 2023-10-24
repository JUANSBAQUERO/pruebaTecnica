<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Authentication\PasswordHasher\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property string $id_usuario
 * @property string|null $nombres
 * @property string|null $apellidos
 * @property string|null $usuario
 * @property string|null $correo
 * @property string|null $password
 * @property \Cake\I18n\FrozenTime|null $fecha_creacion
 * @property bool $estado
 * @property string|null $created_by
 * @property string|null $perfil 
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
     * @var array<string, bool>
     */
    protected $_accessible = [
        'nombres' => true,
        'apellidos' => true,
        'usuario' => true,
        'correo' => true,
        'password' => true,
        'fecha_creacion' => true,
        'estado' => true,
        'created_by' => true,
        'perfil' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array<string>
     */
    protected $_hidden = [
        'password',
    ];

    protected function _setPassword($password) : String {
        if ($password) {
            return (new DefaultPasswordHasher())->hash($password);
        }
    }
}
