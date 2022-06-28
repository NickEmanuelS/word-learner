<?php 
class ControllersController extends AppController{
    /**
        action para view mensagem 
        aqui nуo definiremos nenhum corpo pois
        nуo se faz necessсrio
    */
    public function mensagem(){}
    /**
        funчуo para a chamada ajax 
        funcionamento muito simples
        setamos uma string para uma
        variсvel chamada 'mensagem'
        que ficarс disponэvel
        na em ajax_msg.ctp
    */
    public function ajaxMsg(){
        $this->layout = "ajax";
        //aqui poderiamos ter, requisiчѕes a banco de dados
        //validaчѕes, chamada р outas DataSources etc.  
        $this->set("mensagem","Olс Mundo! CakePHP Ajax");    
    }
}
?>