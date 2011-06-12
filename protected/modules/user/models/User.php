<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $lastlogin
 * @property string $createdate
 * @property string $salt
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Profile[] $profiles
 * @property UserContact[] $userContacts
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, lastlogin, createdate, salt', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('username, password', 'length', 'max'=>32),
			array('email', 'length', 'max'=>50),
			array('salt', 'length', 'max'=>25),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password, email, lastlogin, createdate, salt, status', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'profiles' => array(self::HAS_MANY, 'Profile', 'user_id'),
			'userContacts' => array(self::HAS_MANY, 'UserContact', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Password',
			'email' => 'Email',
			'lastlogin' => 'Lastlogin',
			'createdate' => 'Createdate',
			'salt' => 'Salt',
			'status' => 'Status',
		);
	}
        
        public function scopes()
        {
            return array(                
                'notsafe'=>array(
                    'select' => 'id, username, password, email, lastlogin , createdate , salt , status',
                ),
            );
        }
        
        public function defaultScope()
        {
            return array(
                'select' => 'id, username, email, createdate, lastlogin, status',
            );
        }

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('lastlogin',$this->lastlogin,true);
		$criteria->compare('createdate',$this->createdate,true);
		$criteria->compare('salt',$this->salt,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}