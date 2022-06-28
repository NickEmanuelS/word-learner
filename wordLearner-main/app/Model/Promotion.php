<?php
App::uses('AppModel', 'Model');
/**
 * Promotion Model
 *
 */
class Promotion extends AppModel {

	public function beforeSave($options = array()) {
		
		// Data início exibição Promotion site
		if (!empty($this->data['Promotion']['data_inicio_promocao'])) {
			$this->data['Promotion']['data_inicio_promocao'] = $this->dateFormatBeforeSave($this->data['Promotion']['data_inicio_promocao']);        
		}
		
		// Data fim exibição Promotion site
		if (!empty($this->data['Promotion']['data_fim_promocao'])) {
			$this->data['Promotion']['data_fim_promocao'] = $this->dateFormatBeforeSave($this->data['Promotion']['data_fim_promocao']);        
		}
	}
	
	public function afterFind($results, $primary = false) {
	
		foreach ($results as $key => $val) {
			
			// Data início exibição Promotion site
			if (isset($val['Promotion']['data_inicio_promocao'])) {
				$results[$key]['Promotion']['data_inicio_promocao'] = $this->dateFormatAfterFind($val['Promotion']['data_inicio_promocao']);
			}
			
			// Data fim exibição Promotion site
			if (isset($val['Promotion']['data_fim_promocao'])) {
				$results[$key]['Promotion']['data_fim_promocao'] = $this->dateFormatAfterFind($val['Promotion']['data_fim_promocao']);
			}
		}
		return $results;
	}
	
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
