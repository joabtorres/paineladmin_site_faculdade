<?php

/**
 * A classe 'controller' é responsável por fazer o carregamento das views, concebe paginação e verifica nível de usuário
 * 
 * @author Joab Torres <joabtorres1508@gmail.com>
 * @version 1.0
 * @copyright  (c) 2017, Joab Torres Alencar - Analista de Sistemas 
 * @access public
 * @package core
 * @example classe controller
 */
class controller extends helper {

    /**
     * Está função é responsável para carrega uma view;
     * @param String viewName - nome da view;
     * @param array $viewData - Dados para serem carregados na view
     * @access protected
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function loadView($viewName, $viewData = array()) {
        extract($viewData);
        include 'views/' . $viewName . ".php";
    }

    /**
     * Está função é responsável para carrega um template estático, a onde ela chama chama uma função lo;
     * @param String viewName - nome da view;
     * @param array $viewData - Dados para serem carregados na view
     * @access protected
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    protected function loadTemplate($viewName, $viewData = array()) {
        include 'views/template.php';
    }

    /**
     * Está função é responsável para carrega uma view dinamica dentro de um template estático
     * @param String viewName - nome da view;
     * @param array $viewData - Dados para serem carregados na view
     * @access protected
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    protected function loadViewInTemplate($viewName, $viewData = array()) {
        extract($viewData);
        include 'views/' . $viewName . ".php";
    }

    /**
     * Está função é responsável para inicializar a sessa do usuário do sistema, seja ele usuario comum ou administrador
     * @param array $usuario - dados encontrados no banco de dados do usuário
     * @access protected
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    protected function setUserSession($usuario) {
        //inicando sessao
        $_SESSION['usuario'] = array();
        //codigo
        $_SESSION['usuario']['id'] = $usuario['id'];
        //nome
        $_SESSION['usuario']['nome'] = $usuario['nome'];
        //img
        $_SESSION['usuario']['imagem'] = $usuario['imagem'];
        //statu
        $_SESSION['usuario']['status'] = $usuario['status'];
    }

    /**
     * verifica se o usuário está logado
     * @return bollean 
     * @access protected
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    protected function checkUser() {
        if (isset($_SESSION['usuario']) && is_array($_SESSION['usuario']) && isset($_SESSION['usuario']['status'])) {
            if ($_SESSION['usuario']['status'] == 1) {
                return true;
            }
        } else {
            return false;
        }
    }

    /**
     * Esta função retorna o nome do usuario logado
     * @return string nome do usuario
     */
    protected function getNome() {
        if (isset($_SESSION['usuario']) && is_array($_SESSION['usuario']) && isset($_SESSION['usuario']['status'])) {
            if ($_SESSION['usuario']['status'] == 1) {
                return $_SESSION['usuario']['nome'];
            }
        } else {
            return "Usuario";
        }
    }

    /**
     * Esta função retorna o id do usuario logado
     * @return string id do usuario
     */
    protected function getId() {
        if (isset($_SESSION['usuario']) && is_array($_SESSION['usuario'])) {
            if ($_SESSION['usuario']['status'] == 1) {
                return $_SESSION['usuario']['id'];
            }
        } else {
            return false;
        }
    }

    /**
     * Está função verifica  se o e-mail do usuário é valido, ou seja, se seu servido de email existe.
     * @param String $email
     * @return bollean 
     * @access protected
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    protected function validar_email($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            list($usuario, $dominio) = explode("@", $email);
            if (checkdnsrr($dominio, 'MX')) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Está função verifica se o usuário está cadastrado no sistema, se ele estive será criado uma nova senha e enviado para o respectivo email
     * @return bollean 
     * @access protected
     * @author Joab Torres <joabtorres1508@gmail.com>
     * 
     */
    protected function recuperar($email) {
        if ($this->checkUser()) {
            $usuarioModel = new usuario();
            $senha = $usuarioModel->newpassword($email);

            if ($senha) {
                // envia email ao usuário
                $assunto = 'PAINEL CAVANIS';
                $destinatario = $email;
                $mensagem = '<!DOCTYPE html>
			<html lang="pt-br">
			<head>
				<meta charset="UTF-8">
				<title>' . $assunto . '</title>
			</head>
			<body>
				<div style="width: 98%;display: block;margin: 10px auto;padding: 0;font-family: sans-serif, Arial;border : 2px solid #357ca5;">
				<h3 style="background: #357ca5;color: white;padding: 10px;margin: 0;">Nova Senha! <br/> <small>' . $assunto . ' - Nova Senha</small></h3>
					<p style="padding: 10px;line-height: 30px;">
                                            Você solicitou uma nova senha de acesso ao <b>' . $assunto . '</b>, confira abaixo sua nova senha de acesso: <br/>
                                            <span style="font-weight:bold">Email: </span><span style="color: #357ca5;">' . $email . '</span><br/>
                                            <span style="font-weight:bold">Nova Senha: </span> <span style="color: #357ca5;">' . $senha . '</span><br/>
                                                 <a href="' . BASE_URL . '" style="text-decoration: none;">Carregar Página</a>
					</p>
				</div>
			</body>
			</html>';
                $assunto .= " - NOVA SENHA";
                $headers = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-Type: text/html; charset=UTF-8' . "\r\n";
                $headers .= 'From: ' . $assunto . ' <contato=cavanis.edu.br>' . "\r\n";
                $headers .= 'X-Mailer: PHP/' . phpversion();
                mail($destinatario, $assunto, $mensagem, $headers);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responsável desloga o usuário do sistema, limpando a $_SESSION['user_sgl']
     * 
     * @access protected
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    protected function logout() {
        if (isset($_SESSION)) {
            $_SESSION = array();
            header('location: ' . BASE_URL . 'home');
        }
    }

}
