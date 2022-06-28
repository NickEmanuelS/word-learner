<?php
// app/Model/User.php
class User extends AppModel {
	public $name = 'User';
	
	//Bloco de validação
    public $validate = array(
		//Validação do campo nome
        'name' => array(
			//Validação nome 1
			'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Required field'
			)
        ),
		//Validação do campo email
        'email' => array(
			//Validação email 1
			'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Required field'
			),
			//Validação email 2
			'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'This email is already used by another user. Input please a different email!'
            )
        ),
		//Validação do campo usuário
        'username' => array(
			//Validação usuário 1
            'alphaNumeric' => array(
                'rule' => 'alphaNumeric',
                'message' => 'User should contain only characters.'
            ),
			//Validação usuário 2
			'between' => array(
                'rule' => array('lengthBetween', 5, 15),
                'message' => 'User should contain between 5 and 15 characters.'
            ),
			//Validação usuário 3
			'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'This user is already use by another user. Input please a different user.!'
            )
        ),
		//Validação do campo senha
		'password' => array(
			//Validação senha 1
			'between' => array(
				'rule' => array('lengthBetween', 6, 18),
				'message' => 'Password should contain between 6 and 18 characters.'
			)
        ),
    );
	
	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
		}
		return true;
	}

}

?>