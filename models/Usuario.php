<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "usuario".
 *
 * @property int $id
 * @property int $roles_id
 * @property string $nombre
 * @property string $apellidos
 * @property string $email
 * @property string $username
 * @property string $password
 * @property int $bloqueado
 * @property string $creado
 * @property string $modificado
 *
 * @property Clientes[] $clientes
 * @property Roles $roles
 */
class Usuario extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['roles_id', 'nombre', 'apellidos', 'email', 'username', 'password', 'creado', 'modificado'], 'required'],
            [['roles_id'], 'integer'],
            [['creado', 'modificado'], 'safe'],
            [['nombre'], 'string', 'max' => 45],
            [['apellidos'], 'string', 'max' => 90],
            [['email'], 'string', 'max' => 150],
            [['username'], 'string', 'max' => 15],
            [['password'], 'string', 'max' => 64],
            [['bloqueado'], 'string', 'max' => 1],
            [['email'], 'unique'],
            [['username'], 'unique'],
            [['roles_id'], 'exist', 'skipOnError' => true, 'targetClass' => Roles::className(), 'targetAttribute' => ['roles_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'roles_id' => 'Roles ID',
            'nombre' => 'Nombre',
            'apellidos' => 'Apellidos',
            'email' => 'Email',
            'username' => 'Username',
            'password' => 'Password',
            'bloqueado' => 'Bloqueado',
            'creado' => 'Creado',
            'modificado' => 'Modificado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientes()
    {
        return $this->hasMany(Clientes::className(), ['usuario_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoles()
    {
        return $this->hasOne(Roles::className(), ['id' => 'roles_id']);
    }

    /**
     * Finds an identity by the given ID.
     *
     * @param string|integer $id the ID to be looked for
     * @return static|null the identity object that matches the given ID.
     * it looks for an instance of the identity class using the specified user ID. This method is used when you need to maintain the login status via session.
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @return int|string current user ID
     * it returns the ID of the user represented by this identity instance.
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     * it looks for an instance of the identity class using the specified access token. This method is used when you need to authenticate a user by a single secret token (e.g. in a stateless RESTful application).
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {

    }

    /**
     * @return string current user auth key
     * it returns a key used to verify cookie-based login. The key is stored in the login cookie and will be later compared with the server-side version to make sure the login cookie is valid.
     */
    public function getAuthKey()
    {

    }

    /**
     * @param string $authKey
     * @return boolean if auth key is valid for current user
     * it implements the logic for verifying the cookie-based login key
     */
    public function validateAuthKey($authKey)
    {

    }

    /**
     * Finds user by username
     *
     * @param  string $username
     * @return array|\yii\db\ActiveRecord
     */
    public static function findByUsername($username)
    {
        return static::find()->where(['or', ['username' => $username, 'bloqueado' => '0'], ['email' => $username, 'bloqueado' => '0']])->one();
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     * @return string, exactly password hashed
     * @throws \yii\base\Exception
     */
    public function setPassword($password)
    {
        return ($this->password = Yii::$app->security->generatePasswordHash($password));
    }

}
