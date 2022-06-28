<?php 
class ControllersController extends AppController{
    /**
        action para view mensagem 
        aqui n�o definiremos nenhum corpo pois
        n�o se faz necess�rio
    */
    public function mensagem(){}
    /**
        fun��o para a chamada ajax 
        funcionamento muito simples
        setamos uma string para uma
        vari�vel chamada 'mensagem'
        que ficar� dispon�vel
        na em ajax_msg.ctp
    */
    public function ajaxMsg(){
        $this->layout = "ajax";
        //aqui poderiamos ter, requisi��es a banco de dados
        //valida��es, chamada � outas DataSources etc.  
        $this->set("mensagem","Ol� Mundo! CakePHP Ajax");    
    }
}
?>