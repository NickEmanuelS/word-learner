<?php
// app/Model/Product.php
class Product extends AppModel {
	public $name = 'Product';
	
	//Bloco de validação
    public $validate = array(
		//Validação do campo tipo do produto
        'flg_tipo_produto' => array(
			//Validação tipo do produto 1
			'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Campo obrigatório'
			)
        ),
		//Validação do campo altura da foto
        'foto_altura' => array(
			//Validação altura da foto 1
			'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Campo obrigatório'
			)
        ),
		//Validação do campo largura da foto
        'foto_largura' => array(
			//Validação largura da foto 1
			'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Campo obrigatório'
			)
        ),
		//Validação do campo tamanho da folha
        'tamanho_folha' => array(
			//Validação tamanho da folha 1
			'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Campo obrigatório'
			)
        ),
		//Validação do campo tipo do papel
        'tipo_papel' => array(
			//Validação tipo do papel 1
			'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Campo obrigatório'
			)
        ),
		//Validação do campo tipo do papel foto
        'tipo_papel_foto' => array(
			//Validação tipo do papel 1
			'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Campo obrigatório'
			)
        ),
		//Validação do campo cor
        'tipo_cor' => array(
			//Validação cor 1
			'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Campo obrigatório'
			)
        ),
		//Validação do campo valor
        'valor' => array(
			//Validação valor 1
			'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Campo obrigatório'
			)
        ),
		//Validação do campo produto em falta
        'flg_em_falta' => array(
			//Validação produto em falta 1
			'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Campo obrigatório'
			)
        ),
    );

	public function beforeSave($options = array()) {
		
		// Tratando array >> string Produtos Recomendados
		if (!empty($this->data['Product']['cod_produto_recomendado'])) {
			
			$recomendacoes = $this->data['Product']['cod_produto_recomendado'];
			$recomendacaoFinal = '';
			 
			foreach ($recomendacoes as $stringArray) {
				if(!empty($recomendacaoFinal)){
					$recomendacaoFinal = $recomendacaoFinal.",".$stringArray;
				}
					else{
						$recomendacaoFinal = $recomendacaoFinal.$stringArray;
					}
			}
			
			//Seta o campo como string
			$this->data['Product']['cod_produto_recomendado'] = $recomendacaoFinal;
		}
		
		//Retirando barras "/" da string para erradicar erro ocorrido com o GET
		// quando a barra é inserida no nome do produto

		
		//$nomeProduto = $this->data['Product']['nome'];
		//$nomeProduto = str_replace("/", "-", $nomeProduto);
		//$nomeProduto = str_replace("\\", "-", $nomeProduto);
		//$this->data['Product']['nome'] = $nomeProduto;
	}
	
	public function afterFind($results, $primary = false) {
	
		foreach ($results as $key => $val) {
			// Produtos recomendados
			if (isset($val['Product']['cod_produto_recomendado'])) {
					$array=explode(",",$val['Product']['cod_produto_recomendado']);
					$results[$key]['Product']['cod_produto_recomendado'] = $array;
			}
		}
		return $results;
	}
}
