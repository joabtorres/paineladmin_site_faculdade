<?php

class homeController extends controller {

    public function index() {
        if ($this->checkUser()) {
            $viewName = "home";
            $dados = array();
            $crud = new crud_db();
            $dados['qtd_slide'] = $crud->read_specific("SELECT COUNT(id) as qtd FROM slide");
            $dados['qtd_categoria'] = $crud->read_specific("SELECT COUNT(id) as qtd FROM categoria");
            $dados['qtd_post'] = $crud->read_specific("SELECT COUNT(id) as qtd FROM post");
            $dados['qtd_user'] = $crud->read_specific("SELECT COUNT(id) as qtd FROM usuario");
            $this->loadTemplate($viewName, $dados);
        } else {
            $url = "location: " . BASE_URL . 'login';
            header($url);
        }
    }

    public function sair() {
        $url = "location: " . BASE_URL . 'login';
        header($url);
    }

}
