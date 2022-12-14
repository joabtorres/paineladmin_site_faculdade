<?php

class editarController extends controller {

    public function index() {
        
    }

    public function slide($id) {
        if ($this->checkUser()) {
            $viewName = "slide/editar";
            $dados = array();
            $crud = new crud_db();
            $slide = $crud->read_specific("SELECT * FROM slide WHERE md5(id)=:id", array('id' => $id));
            $dados['slide'] = $slide;
            //submit
            if (isset($_POST['nSalvar'])) {
                $arrayCad = array();
                $arrayCad['id'] = addslashes($_POST['nId']);
                //link
                $arrayCad['link'] = addslashes($_POST['nLink']);
                //status
                $arrayCad['status'] = $_POST['nStatus'] == 1 ? 1 : 0;
                //imagem
                if (isset($_FILES['tImagem']) && ($_FILES['tImagem']['error'] == 0)) {
                    if ($this->verificarExtensao($_FILES['tImagem'])) {
                        $arrayCad['imagem'] = $this->save_img_slide($_FILES['tImagem']);
                        $crud->delete_file($slide['imagem']);
                    } else {
                        $dados['erro'] = array('class' => 'alert-danger', 'msg' => '<i class="fa fa-times"></i> Arquivo inválido, envie uma imagem com a extensão (jpg, jpeg ou png).');
                    }
                } else {
                    $arrayCad['imagem'] = $slide['imagem'];
                }
                if (empty($dados['erro'])) {
                    $result = $crud->update("UPDATE slide SET imagem=:imagem, link=:link, status=:status WHERE id=:id", $arrayCad);
                    if ($result) {
                        $dados['erro']['msg'] = '<i class="fa fa-check" aria-hidden="true"></i> Alteração realizada com sucesso!';
                        $dados['erro']['class'] = 'alert-success';
                    }
                    $dados['slide'] = $arrayCad;
                } else {
                    $dados['slide'] = $arrayCad;
                }
            }

            $this->loadTemplate($viewName, $dados);
        } else {
            $url = "location: " . BASE_URL . "login";
            header($url);
        }
    }

    public function usuario($id) {
        if ($this->checkUser()) {
            $viewName = "usuario/editar";
            $dados = array();
            $userModel = new usuario();
            $usuario = $userModel->read_specific("SELECT * FROM usuario WHERE md5(id)=:id", array('id' => $id));
            $dados['usuario'] = $usuario;
            //Array que vai armazena os dados do usuário;
            $arrayCad = array();
            if (isset($_POST['nSalvar'])) {

                $arrayCad['id'] = addslashes($_POST['nId']);
                //nome
                if (!empty($_POST['nNome'])) {
                    $arrayCad['nome'] = addslashes($_POST['nNome']);
                } else {
                    $dados['usuario_erro']['nome']['msg'] = 'Informe o nome';
                    $dados['usuario_erro']['nome']['class'] = 'has-error';
                }
                //email
                if (!empty($_POST['nEmail'])) {
                    $arrayCad['email'] = addslashes($_POST['nEmail']);
                    if ($userModel->read_specific('SELECT * FROM usuario WHERE email=:email AND id!=:id', array('email' => $arrayCad['email'], 'id' => $usuario['id']))) {
                        $dados['usuario_erro']['email']['msg'] = 'E-mail já cadastrado';
                        $dados['usuario_erro']['email']['class'] = 'has-error';
                        $dados['erro']['msg'] = '<i class="fa fa-info-circle" aria-hidden="true"></i> Não é possível cadastrar um e-mail já cadastrado, por favor informe outro endereço de e-mail';
                        $dados['erro']['class'] = 'alert-danger';
                        $arrayCad['email'] = null;
                    }
                } else {
                    $dados['usuario_erro']['email']['msg'] = 'Informe o e-mail';
                    $dados['usuario_erro']['email']['class'] = 'has-error';
                }

                //senha
                if (!empty($_POST['nSenha']) && !empty($_POST['nRepetirSenha'])) {
                    //senha
                    if ($_POST['nSenha'] == $_POST['nRepetirSenha']) {
                        $arrayCad['senha'] = $_POST['nSenha'];
                    } else {
                        $dados['usuario_erro']['senha']['msg'] = "Os campos 'Senha' e 'Repetir Senha' não estão iguais! ";
                        $dados['usuario_erro']['senha']['class'] = 'has-error';
                    }
                }
                //status
                $arrayCad['status'] = (!empty($_POST['nStatus'])) ? 1 : 0;

                //imagem
                if (isset($_FILES['tImagem']) && ($_FILES['tImagem']['error'] == 0 ) && !empty($_FILES['tImagem'])) {
                    if ($this->verificarExtensao($_FILES['tImagem'])) {
                        $arrayCad['imagem'] = $_FILES['tImagem'];
                        $arrayCad['delete_imagem'] = $usuario['imagem'];
                    }
                } else {
                    $arrayCad['imagem'] = $usuario['imagem'];
                }

                if (isset($dados['usuario_erro']) && !empty($dados['usuario_erro'])) {
                    $dados['erro']['msg'] = '<i class="fa fa-info-circle" aria-hidden="true"></i> Preencha todos os campos obrigatórios (*).';
                    $dados['erro']['class'] = 'alert-danger';
                    $dados['usuario'] = $arrayCad;
                } else {
                    $dados['usuario'] = $userModel->update($arrayCad);
                    $dados['erro']['msg'] = '<i class="fa fa-check" aria-hidden="true"></i> Alteração realizada com sucesso!';
                    $dados['erro']['class'] = 'alert-success';
                }
            }

            $this->loadTemplate($viewName, $dados);
        } else {
            $url = "location: " . BASE_URL . "login";
            header($url);
        }
    }

    public function categoria($id) {
        if ($this->checkUser()) {
            $viewName = "categoria/editar";
            $dados = array();
            $crud = new crud_db();
            $categoria = $crud->read_specific("SELECT * FROM categoria WHERE md5(id)=:id", array('id' => $id));
            $dados['categoria'] = $categoria;
            if (isset($_POST['nSalvar'])) {
                $arrayCad = array();
                $arrayCad['id'] = addslashes($_POST['nId']);
                //nome
                if (!empty($_POST['nNome'])) {
                    $arrayCad['nome'] = addslashes($_POST['nNome']);
                    $checkResult = $crud->read_specific("SELECT * FROM categoria WHERE nome=:nome AND id!=:id", array('nome' => $arrayCad['nome'], 'id' => $categoria['id']));
                    if (is_array($checkResult) && !empty($checkResult)) {
                        $dados['erro'] = array('class' => 'alert-danger', 'msg' => '<i class="fa fa-times"></i> Categoria já registrada');
                    }
                } else {
                    $dados['erro'] = array('class' => 'alert-danger', 'msg' => '<i class="fa fa-times"></i> Preenchar os campos obrigatórios.');
                }
                //status
                $arrayCad['status'] = $_POST['nStatus'] == 1 ? 1 : 0;

                if (empty($dados['erro'])) {
                    $result = $crud->update("UPDATE categoria SET nome=:nome, status=:status WHERE id=:id", $arrayCad);
                    if ($result) {
                        $dados['erro']['msg'] = '<i class="fa fa-check" aria-hidden="true"></i> Alteração realizada com sucesso!';
                        $dados['erro']['class'] = 'alert-success';
                    }
                    $dados['categoria'] = $arrayCad;
                } else {
                    $dados['categoria'] = $arrayCad;
                }
            }
            $this->loadTemplate($viewName, $dados);
        } else {
            $url = "location: " . BASE_URL . "login";
            header($url);
        }
    }

    public function post($id) {
        if ($this->checkUser()) {
            $viewName = "post/editar";
            $dados = array();
            $crudModel = new crud_db();
            $postModel = new post();

            $post = $postModel->readPost($id);

            $dados['post'] = $post;
            $dados['categorias'] = $crudModel->read("SELECT * FROM categoria WHERE status = 1 ORDER BY nome ASC");
            $dados['usuarios'] = $crudModel->read("SELECT * FROM usuario WHERE status = 1 ORDER BY nome ASC");
            if (isset($_POST['nSalvar'])) {
                $arrayCad = array();
                //id
                $arrayCad['id'] = addslashes($_POST['nId']);
                //categoria
                if (!empty($_POST['nCategoria'])) {
                    $arrayCad['id_categoria'] = addslashes($_POST['nCategoria']);
                } else {
                    $dados['post_erro']['categoria']['msg'] = 'Informe a categoria';
                    $dados['post_erro']['categoria']['class'] = 'has-error';
                    $dados['erro'] = array('class' => 'alert-danger', 'msg' => '<i class="fa fa-times"></i> Preenchar os campos obrigatórios.');
                }
                //usuario
                if (!empty($_POST['nUsuario'])) {
                    $arrayCad['id_usuario'] = addslashes($_POST['nUsuario']);
                } else {
                    $dados['post_erro']['autor']['msg'] = 'Informe o(a) autor(a)';
                    $dados['post_erro']['autor']['class'] = 'has-error';
                    $dados['erro'] = array('class' => 'alert-danger', 'msg' => '<i class="fa fa-times"></i> Preenchar os campos obrigatórios.');
                }
                //data
                if (!empty($_POST['nData'])) {
                    $arrayCad['data'] = $this->formatDateBD($_POST['nData']);
                } else {
                    $dados['post_erro']['data']['msg'] = 'Informe a data';
                    $dados['post_erro']['data']['class'] = 'has-error';
                    $dados['erro'] = array('class' => 'alert-danger', 'msg' => '<i class="fa fa-times"></i> Preenchar os campos obrigatórios.');
                }
                //Titulo
                if (!empty($_POST['nTitulo'])) {
                    $arrayCad['titulo'] = addslashes($_POST['nTitulo']);
                } else {
                    $dados['post_erro']['titulo']['msg'] = 'Informe o título';
                    $dados['post_erro']['titulo']['class'] = 'has-error';
                    $dados['erro'] = array('class' => 'alert-danger', 'msg' => '<i class="fa fa-times"></i> Preenchar os campos obrigatórios.');
                }
                //previo
                if (!empty($_POST['nDescricao'])) {
                    $arrayCad['previo'] = $_POST['nDescricao'];
                } else {
                    $dados['post_erro']['previo']['msg'] = 'Informe uma descrição prévia';
                    $dados['post_erro']['previo']['class'] = 'has-error';
                    $dados['erro'] = array('class' => 'alert-danger', 'msg' => '<i class="fa fa-times"></i> Preenchar os campos obrigatórios.');
                }
                //POST
                $arrayCad['texto'] = $_POST['nPost'];

                //imagem
                if (isset($_FILES['tImagem']) && ($_FILES['tImagem']['error'] == 0)) {
                    if ($this->verificarExtensao($_FILES['tImagem'])) {
                        $arrayCad['imagem'] = $_FILES['tImagem'];
                        $arrayCad['delete_imagem'] = $post['imagem'];
                    } else {
                        $dados['erro'] = array('class' => 'alert-danger', 'msg' => '<i class="fa fa-times"></i> Arquivo inválido, envie uma imagem com a extensão (jpg, jpeg ou png).');
                    }
                } else {
                    $arrayCad['imagem'] = $post['imagem'];
                }
                for ($i = 0; $i < addslashes($_POST["tQnt_fotos"]); $i++) {
                    if (isset($_FILES['tImagem-' . ($i + 1)]) && !empty($_FILES['tImagem-' . ($i + 1)])) {
                        if ($this->verificarExtensao($_FILES['tImagem-' . ($i + 1)])) {
                            $arrayCad["imagens"][$i] = $_FILES['tImagem-' . ($i + 1)];
                        } else {
                            $arrayCad["imagens"][$i]['grande'] = $_POST['nImagemLarge-' . ($i + 1)];
                            $arrayCad["imagens"][$i]['min'] = $_POST['nImagemMin-' . ($i + 1)];
                        }
                    }
                }
                $arrayCad['status'] = $_POST['nStatus'] == 1 ? 1 : 0;


                if (empty($dados['erro'])) {
                    $result = $postModel->update($arrayCad);
                    if ($result) {
                        $dados['post'] = $result;
                        $dados['erro']['msg'] = '<i class="fa fa-check" aria-hidden="true"></i> Alteração realizada com sucesso!';
                        $dados['erro']['class'] = 'alert-success';
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
