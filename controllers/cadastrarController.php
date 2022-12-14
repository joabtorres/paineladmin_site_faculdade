<?php

class cadastrarController extends controller {

    public function index() {
        $this->post();
    }

    public function usuario() {
        if ($this->checkUser()) {
            $viewName = "usuario/cadastro";
            $dados = array();
            if (!isset($_POST['nSalvar'])) {
                $_SESSION['last_request'] = null;
            }
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $requisicao = md5(implode($_POST));

                if (isset($_SESSION['last_request']) && $_SESSION['last_request'] == $requisicao) {
                    $url = "Location: " . BASE_URL . "cadastrar/usuario";
                    header($url);
                } else {
                    $_SESSION['last_request'] = $requisicao;
                    $userModel = new usuario();
                    //Array que vai armazena os dados do usuário;
                    $usuario = array();
                    if (isset($_POST['nSalvar'])) {
                        //nome
                        if (!empty($_POST['nNome'])) {
                            $usuario['nome'] = addslashes($_POST['nNome']);
                        } else {
                            $dados['usuario_erro']['nome']['msg'] = 'Informe o nome';
                            $dados['usuario_erro']['nome']['class'] = 'has-error';
                        }
                        //email
                        if (!empty($_POST['nEmail'])) {
                            $usuario['email'] = addslashes($_POST['nEmail']);
                            if ($userModel->read_specific('SELECT * FROM usuario WHERE email=:email', array('email' => $usuario['email']))) {
                                $dados['usuario_erro']['email']['msg'] = 'E-mail já cadastrado';
                                $dados['usuario_erro']['email']['class'] = 'has-error';
                                $dados['erro']['msg'] = '<i class="fa fa-info-circle" aria-hidden="true"></i> Não é possível cadastrar um e-mail já cadastrado, por favor informe outro endereço de e-mail';
                                $dados['erro']['class'] = 'alert-danger';
                                $usuario['email'] = null;
                            }
                        } else {
                            $dados['usuario_erro']['email']['msg'] = 'Informe o e-mail';
                            $dados['usuario_erro']['email']['class'] = 'has-error';
                        }

                        //senha
                        if (!empty($_POST['nSenha']) && !empty($_POST['nRepetirSenha'])) {
                            //senha
                            if ($_POST['nSenha'] == $_POST['nRepetirSenha']) {
                                $usuario['senha'] = $_POST['nSenha'];
                            } else {
                                $dados['usuario_erro']['senha']['msg'] = "Os campos 'Senha' e 'Repetir Senha' não estão iguais! ";
                                $dados['usuario_erro']['senha']['class'] = 'has-error';
                            }
                        } else {
                            $dados['usuario_erro']['senha']['msg'] = "Os campos 'Senha' e 'Repetir Senha' devem ser preenchidos";
                            $dados['usuario_erro']['senha']['class'] = 'has-error';
                        }
                        //status
                        $usuario['status'] = (!empty($_POST['nStatus'])) ? addslashes($_POST['nStatus']) : 0;

                        //imagem
                        if (isset($_FILES['tImagem']) && ($_FILES['tImagem']['error'] == 0 && $this->verificarExtensao($_FILES['tImagem']))) {
                            $usuario['imagem'] = $_FILES['tImagem'];
                        }
                        if (isset($dados['usuario_erro']) && !empty($dados['usuario_erro'])) {
                            $dados['erro']['msg'] = '<i class="fa fa-info-circle" aria-hidden="true"></i> Preencha todos os campos obrigatórios (*).';
                            $dados['erro']['class'] = 'alert-danger';
                            $dados['usuario'] = $usuario;
                        } else {
                            $userModel->create($usuario);
                            $dados['erro']['msg'] = '<i class="fa fa-check" aria-hidden="true"></i> Cadastro realizado com sucesso!';
                            $dados['erro']['class'] = 'alert-success';
                            $_POST = array();
                        }
                    }
                }
            }
            $this->loadTemplate($viewName, $dados);
        } else {
            $url = "location: " . BASE_URL . "login";
            header($url);
        }
    }

    public function slide() {
        if ($this->checkUser()) {
            $viewName = "slide/cadastro";
            $dados = array();
            if (!isset($_POST['nSalvar'])) {
                $_SESSION['last_request'] = null;
            }
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $requisicao = md5(implode($_POST));

                if (isset($_SESSION['last_request']) && $_SESSION['last_request'] == $requisicao) {
                    $url = "Location: " . BASE_URL . "cadastrar/slide";
                    header($url);
                } else {
                    $_SESSION['last_request'] = $requisicao;
                    //submit
                    if (isset($_POST['nSalvar'])) {
                        $arrayCad = array();
                        //link
                        $arrayCad['link'] = addslashes($_POST['nLink']);
                        //status
                        $arrayCad['status'] = $_POST['nStatus'] == 1 ? 1 : 0;
                        //imagem
                        if (isset($_FILES['tImagem']) && ($_FILES['tImagem']['error'] == 0 && $this->verificarExtensao($_FILES['tImagem']))) {
                            $arrayCad['imagem'] = $this->save_img_slide($_FILES['tImagem']);
                        } else {
                            $dados['erro'] = array('class' => 'alert-danger', 'msg' => '<i class="fa fa-times"></i> Arquivo inválido, envie uma imagem com a extensão (jpg, jpeg ou png).');
                        }
                        if (empty($dados['erro'])) {
                            $crud = new crud_db();
                            $result = $crud->create("INSERT INTO slide (imagem, link, status) VALUES (:imagem, :link, :status)", $arrayCad);
                            if ($result) {
                                $dados['erro']['msg'] = '<i class="fa fa-check" aria-hidden="true"></i> Cadastro realizado com sucesso!';
                                $dados['erro']['class'] = 'alert-success';
                            }
                        } else {
                            $dados['slide'] = $arrayCad;
                        }
                    }
                }
            }

            $this->loadTemplate($viewName, $dados);
        } else {
            $url = "location: " . BASE_URL . "login";
            header($url);
        }
    }

    public function categoria() {
        if ($this->checkUser()) {
            $viewName = "categoria/cadastro";
            $dados = array();
            if (!isset($_POST['nSalvar'])) {
                $_SESSION['last_request'] = null;
            }
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $requisicao = md5(implode($_POST));

                if (isset($_SESSION['last_request']) && $_SESSION['last_request'] == $requisicao) {
                    $url = "Location: " . BASE_URL . "cadastrar/categoria";
                    header($url);
                } else {
                    $_SESSION['last_request'] = $requisicao;
                    //submit
                    $crud = new crud_db();
                    if (isset($_POST['nSalvar'])) {
                        $arrayCad = array();
                        //nome
                        if (!empty($_POST['nNome'])) {
                            $arrayCad['nome'] = addslashes($_POST['nNome']);
                            $checkResult = $crud->read_specific("SELECT * FROM categoria WHERE nome=:nome", array('nome' => $arrayCad['nome']));
                            if (is_array($checkResult) && !empty($checkResult)) {
                                $dados['erro'] = array('class' => 'alert-danger', 'msg' => '<i class="fa fa-times"></i> Categoria já registrada');
                            }
                        } else {
                            $dados['erro'] = array('class' => 'alert-danger', 'msg' => '<i class="fa fa-times"></i> Preenchar os campos obrigatórios.');
                        }
                        //status
                        $arrayCad['status'] = $_POST['nStatus'] == 1 ? 1 : 0;

                        if (empty($dados['erro'])) {
                            $result = $crud->create("INSERT INTO categoria (nome, status) VALUES (:nome, :status)", $arrayCad);
                            if ($result) {
                                $dados['erro']['msg'] = '<i class="fa fa-check" aria-hidden="true"></i> Cadastro realizado com sucesso!';
                                $dados['erro']['class'] = 'alert-success';
                            }
                        } else {
                            $dados['categoria'] = $arrayCad;
                        }
                    }
                }
            }


            $this->loadTemplate($viewName, $dados);
        } else {
            $url = "location: " . BASE_URL . "login";
            header($url);
        }
    }

    public function post() {
        if ($this->checkUser()) {
            $viewName = "post/cadastro";
            $dados = array();
            $crudModel = new crud_db();
            $postModel = new post();
            $dados['categorias'] = $crudModel->read("SELECT * FROM categoria WHERE status = 1 ORDER BY nome ASC");
            $dados['usuarios'] = $crudModel->read("SELECT * FROM usuario WHERE status = 1 ORDER BY nome ASC");
            if (!isset($_POST['nSalvar'])) {
                $_SESSION['last_request'] = null;
            }
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $requisicao = md5(implode($_POST));

                if (isset($_SESSION['last_request']) && $_SESSION['last_request'] == $requisicao) {
                    $url = "Location: " . BASE_URL . "cadastrar/categoria";
                    header($url);
                } else {
                    $_SESSION['last_request'] = $requisicao;
                    if (isset($_POST['nSalvar'])) {
                        $arrayCad = array();
                        //id
                        $resultado = $crudModel->read_specific("SELECT id FROM post ORDER BY id DESC");
                        $arrayCad['id'] = ++$resultado['id'];
                        //categoria
                        if (!empty($_POST['nCategoria'])) {
                            $arrayCad['id_categoria'] = addslashes($_POST['nCategoria']);
                        } else {
                            $dados['post_erro']['categoria']['msg'] = 'Informe a categoria';
                            $dados['post_erro']['categoria']['class'] = 'has-error';
                        }
                        //usuario
                        if (!empty($_POST['nUsuario'])) {
                            $arrayCad['id_usuario'] = addslashes($_POST['nUsuario']);
                        } else {
                            $dados['post_erro']['autor']['msg'] = 'Informe o(a) autor(a)';
                            $dados['post_erro']['autor']['class'] = 'has-error';
                        }
                        //data
                        if (!empty($_POST['nData'])) {
                            $arrayCad['data'] = $this->formatDateBD($_POST['nData']);
                        } else {
                            $dados['post_erro']['data']['msg'] = 'Informe a data';
                            $dados['post_erro']['data']['class'] = 'has-error';
                        }
                        //Titulo
                        if (!empty($_POST['nTitulo'])) {
                            $arrayCad['titulo'] = addslashes($_POST['nTitulo']);
                        } else {
                            $dados['post_erro']['titulo']['msg'] = 'Informe o título';
                            $dados['post_erro']['titulo']['class'] = 'has-error';
                        }
                        //previo
                        if (!empty($_POST['nDescricao'])) {
                            $arrayCad['previo'] = $_POST['nDescricao'];
                        } else {
                            $dados['post_erro']['previo']['msg'] = 'Informe uma descrição prévia';
                            $dados['post_erro']['previo']['class'] = 'has-error';
                        }
                        //POST
                        $arrayCad['texto'] = $_POST['nPost'];

                        //imagem
                        if (isset($_FILES['tImagem']) && ($_FILES['tImagem']['error'] == 0 && $this->verificarExtensao($_FILES['tImagem']))) {
                            $arrayCad['imagem'] = $_FILES['tImagem'];
                        } else {
                            $dados['erro'] = array('class' => 'alert-danger', 'msg' => '<i class="fa fa-times"></i> Arquivo inválido, envie uma imagem com a extensão (jpg, jpeg ou png).');
                        }
                        for ($i = 0; $i < addslashes($_POST["tQnt_fotos"]); $i++) {
                            if (isset($_FILES['tImagem-' . ($i + 1)]) && !empty($_FILES['tImagem-' . ($i + 1)])) {
                                $arrayCad["imagens"][$i] = $_FILES['tImagem-' . ($i + 1)];
                            }
                        }
                        $arrayCad['status'] = $_POST['nStatus'] == 1 ? 1 : 0;


                        if (empty($dados['erro'])) {
                            $result = $postModel->create($arrayCad);
                            if ($result) {
                                $dados['erro']['msg'] = '<i class="fa fa-check" aria-hidden="true"></i> Cadastro realizado com sucesso!';
                                $dados['erro']['class'] = 'alert-success';
                            }
                        } else {
                            $dados['post'] = $arrayCad;
                        }
                    }
                }
            }


            $this->loadTemplate($viewName, $dados);
        } else {
            $url = "location: " . BASE_URL . "login";
            header($url);
        }
    }

    private function verificarExtensao($file) {
        $imagem['extensao'] = explode(".", $file['name']);
        $imagem['extensao'] = strtolower(end($imagem['extensao']));
        if ($imagem['extensao'] == 'jpg' || $imagem['extensao'] == 'jpeg' || $imagem['extensao'] == 'png') {
            return true;
        } else {
            return false;
        }
    }

    private function save_img_slide($file) {
        $imagem = array();
        $largura = 1400;
        $altura = 510;
        $imagem['temp'] = $file['tmp_name'];
        $imagem['extensao'] = explode(".", $file['name']);
        $imagem['extensao'] = strtolower(end($imagem['extensao']));
        $imagem['name'] = md5(rand(1000, 900000) . time()) . '.' . $imagem['extensao'];
        $imagem['diretorio'] = 'uploads/slides';
        if ($imagem['extensao'] == 'jpg' || $imagem['extensao'] == 'jpeg' || $imagem['extensao'] == 'png') {

            list($larguraOriginal, $alturaOriginal) = getimagesize($imagem['temp']);


            $ratio = max($largura / $larguraOriginal, $altura / $alturaOriginal);
            $x = ($larguraOriginal - $largura / $ratio) / 2;
            $y = ($alturaOriginal - $altura / $ratio) / 2;
            $alturaOriginal = $altura / $ratio;
            $larguraOriginal = $largura / $ratio;


            $imagem_final = imagecreatetruecolor($largura, $altura);

            if ($imagem['extensao'] == 'jpg' || $imagem['extensao'] == 'jpeg') {
                $imagem_original = imagecreatefromjpeg($imagem['temp']);
                imagecopyresampled($imagem_final, $imagem_original, 0, 0, $x, $y, $largura, $altura, $larguraOriginal, $alturaOriginal);
                imagejpeg($imagem_final, $imagem['diretorio'] . "/" . $imagem['name'], 90);
            } else if ($imagem['extensao'] == 'png') {
                $imagem_original = imagecreatefrompng($imagem['temp']);
                imagecopyresampled($imagem_final, $imagem_original, 0, 0, $x, $y, $largura, $altura, $larguraOriginal, $alturaOriginal);
                imagepng($imagem_final, $imagem['diretorio'] . "/" . $imagem['name']);
            }
            return $imagem['diretorio'] . "/" . $imagem['name'];
        } else {
            return null;
        }
    }

}
