<?php
App::uses('AppModel', 'Model');
/**
 * Dia Model
 *
 */
class Dia extends AppModel {

	public function beforeSave($options = array()) {
		if (!empty($this->data['Dia']['dia'])) {
			$this->data['Dia']['dia'] = $this->dateFormatBeforeSave($this->data['Dia']['dia']);        
		}
	}
	
	public function afterFind($results, $primary = false) {
	
		foreach ($results as $key => $val) {
			if (isset($val['Dia']['dia'])) {
				$results[$key]['Dia']['dia'] = $this->dateFormatAfterFind($val['Dia']['dia']);
			}
		}
		return $results;
	}

    public $validate = array(
        'dia' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Input study day'
            )
        )
    );
	
	//Converte data formato brasileiro dd/mm/yyyy
	public function dateFormatAfterFind($dateString) {
		return date('d/m/Y', strtotime($dateString));
		
	}
	
	//Converte data formato banco yyyy-mm-dd
	 public function dateFormatBeforeSave($dateString) {
		$format = '/^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/';
		if ($dateString != null && preg_match($format, $dateString, $partes)) {
			$dateString = $partes[3].'-'.$partes[2].'-'.$partes[1];
			return $dateString;
		}
	}

}
