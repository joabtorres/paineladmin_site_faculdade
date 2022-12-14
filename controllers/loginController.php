<?php

class loginController extends controller {

    public function index() {
        $view = "login";
        $dados = array();
        $_SESSION = array();
        if (isset($_POST['nEntrar']) && !empty($_POST['nEntrar'])) {
            //recaptcha validando
            if (!empty($_POST['nSerachUsuario']) && !empty($_POST['nSearchSenha'])) {
                $usuario = array('usuario' => addslashes($_POST['nSerachUsuario']), 'senha' => md5(sha1($_POST['nSearchSenha'])));
                $usuarioModel = new usuario();
                $resultado = $usuarioModel->read_specific('SELECT * FROM usuario WHERE email=:usuario AND senha=:senha', $usuario);
                if (!$resultado) {
                    $dados['erro']['msg'] = '<i class="fa fa-info-circle" aria-hidden="true"></i> O Campo Usuário ou Senha está incorreto!';
                }
                if (isset($resultado) && $resultado['status'] != 1) {
                    $dados['erro']['msg'] = '<i class="fa fa-info-circle" aria-hidden="true"></i> O Acesso deste usuário está <b>DESABILITADO</b>!';
                }
                if (!isset($dados['erro']) && empty($dados['erro'])) {
                    $this->setUserSession($resultado);
                    header("location: home");
                }
            } else {
                $dados['erro']['msg'] = '<i class="fa fa-info-circle" aria-hidden="true"></i> O Campo Usuário ou Senha não está preenchido!';
            }
        }


        $this->loadView($view, $dados);

        //criando nova senha
        if (isset($_POST['nEnviar'])) {
            $email = addslashes(trim($_POST['nEmail']));
            $_POST = null;
            if ($this->validar_email($email) && $this->recuperar($email)) {
                echo '<script>$("#modal_confirmacao_email").modal();</script>';
            } else {
                echo '<script>$("#modal_invalido_email").modal();</script>';
            }
        }
    }

}
