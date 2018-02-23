<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clientes".
 *
 * @property int $id
 * @property int $usuario_id
 * @property string $nombre
 * @property string $nif
 * @property string $email
 * @property int $tel1
 * @property int $tel2
 * @property string $creado
 * @property string $modificado
 *
 * @property Usuario $usuario
 */
class Clientes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'clientes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usuario_id', 'nombre', 'nif', 'email', 'creado', 'modificado'], 'required'],
            [['usuario_id', 'tel1', 'tel2'], 'integer'],
            [['creado', 'modificado'], 'safe'],
            [['nombre'], 'string', 'max' => 45],
            [['nif'], 'string', 'max' => 9],
            [['email'], 'string', 'max' => 150],
            [['email'], 'unique'],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['usuario_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'usuario_id' => 'Usuario ID',
            'nombre' => 'Nombre',
            'nif' => 'NIF',
            'email' => 'Email',
            'tel1' => 'Tel1',
            'tel2' => 'Tel2',
            'creado' => 'Creado',
            'modificado' => 'Modificado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuario::className(), ['id' => 'usuario_id']);
    }
}
