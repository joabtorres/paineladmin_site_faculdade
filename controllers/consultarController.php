<?php

class consultarController extends controller {

    public function index() {
        $url = "location: " . BASE_URL . "consultar/post";
        header($url);
    }

    public function usuario($page = 1) {
        if ($this->checkUser()) {
            $view = "usuario/relatorio";
            $dados = array();
            $usuarioModel = new usuario();
            //consulta todos os usuários pertencente ao respecito núcleo
            $resultado_usuario = $usuarioModel->read('SELECT * FROM usuario ORDER BY id DESC', array());
            if ($resultado_usuario) {
                $dados['usuarios'] = $resultado_usuario;
            }
            //PESQUISAR USUÁRIO
            if (isset($_POST['nBuscar'])) {
                $filtra_por = addslashes($_POST['nSelectBuscar']);
                $campo = addslashes($_POST['nCampo']);
                if ($filtra_por == "Nome") {
                    $dados['usuarios'] = $usuarioModel->read('SELECT * FROM usuario WHERE nome LIKE :campo', array('campo' => "%" . $campo . "%"));
                } else {
                    $dados['usuarios'] = $usuarioModel->read('SELECT * FROM usuario WHERE email LIKE :campo', array('campo' => "%" . $campo . "%"));
                }
                $_POST = array();
            }
            $this->loadTemplate($view, $dados);
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
        } else {
            $url = "location: " . BASE_URL . "home";
            header($url);
        }
    }

    public function slide($page = 1) {
        if ($this->checkUser()) {
            $viewName = "slide/relatorio";
            $crud = new crud_db();
            $dados = array();
            $arraySearch = array();
            $sql = "SELECT * FROM slide WHERE id>0 ";
            $parametros = "";
            if (isset($_GET['nBuscarBT'])) {
                $parametros = "?nStatus=" . $_GET['nStatus'] . "&nBuscarBT=BuscarBT";
                //unidade
                if (!empty($_GET['nStatus'])) {
                    $sql = $sql . " AND status=:status ";
                    $arraySearch['status'] = addslashes($_GET['nStatus']);
                }
                //paginacao
                $limite = 10;
                $total_registro = $crud->read($sql, $arraySearch);
                $total_registro = is_array($total_registro) ? count($total_registro) : 1;
                $paginas = $total_registro / $limite;
                $indice = 0;
                $pagina_atual = (isset($page) && !empty($page)) ? addslashes($page) : 1;
                $indice = ($pagina_atual - 1) * $limite;
                $dados["paginas"] = $paginas;
                $dados["pagina_atual"] = $pagina_atual;
                $dados['metodo_buscar'] = $parametros;
                $sql .= " ORDER BY id DESC LIMIT $indice,$limite ";

                $dados['slides'] = $crud->read($sql, $arraySearch);
            } else {
                //paginacao
                $limite = 10;
                $total_registro = $crud->read($sql);
                $total_registro = is_array($total_registro) ? count($total_registro) : 1;
                $paginas = $total_registro / $limite;
                $indice = 0;
                $pagina_atual = (isset($page) && !empty($page)) ? addslashes($page) : 1;
                $indice = ($pagina_atual - 1) * $limite;
                $dados["paginas"] = $paginas;
                $dados["pagina_atual"] = $pagina_atual;
                $dados['metodo_buscar'] = $parametros;
                $sql .= " ORDER BY id DESC LIMIT $indice,$limite ";

                $dados['slides'] = $crud->read($sql);
            }
            $this->loadTemplate($viewName, $dados);
        } else {
            $url = "location: " . BASE_URL . "home";
            header($url);
        }
    }

    public function categoria($page = 1) {
        if ($this->checkUser()) {
            $viewName = "categoria/relatorio";
            $crud = new crud_db();
            $dados = array();
            $arraySearch = array();
            $sql = "SELECT * FROM categoria WHERE id>0 ";
            $parametros = "";
            if (isset($_GET['nBuscarBT'])) {
                $parametros = "?nStatus=" . $_GET['nStatus'] . "?nNome=" . $_GET['nNome'] . "&nBuscarBT=BuscarBT";
                //unidade
                if (!empty($_GET['nStatus'])) {
                    $sql = $sql . " AND status=:status ";
                    $arraySearch['status'] = addslashes($_GET['nStatus']);
                }
                if (!empty($_GET['nNome'])) {
                    $sql = $sql . " AND nome LIKE :nome ";
                    $arraySearch['nome'] = '%' . $_GET['nNome'] . '%';
                }
                //paginacao
                $limite = 30;
                $total_registro = $crud->read($sql, $arraySearch);
                $total_registro = is_array($total_registro) ? count($total_registro) : 1;
                $paginas = $total_registro / $limite;
                $indice = 0;
                $pagina_atual = (isset($page) && !empty($page)) ? addslashes($page) : 1;
                $indice = ($pagina_atual - 1) * $limite;
                $dados["paginas"] = $paginas;
                $dados["pagina_atual"] = $pagina_atual;
                $dados['metodo_buscar'] = $parametros;
                $sql .= " ORDER BY id DESC  LIMIT $indice,$limite ";

                $dados['categorias'] = $crud->read($sql, $arraySearch);
            } else {
                //paginacao
                $limite = 30;
                $total_registro = $crud->read($sql);
                $total_registro = is_array($total_registro) ? count($total_registro) : 1;
                $paginas = $total_registro / $limite;
                $indice = 0;
                $pagina_atual = (isset($page) && !empty($page)) ? addslashes($page) : 1;
                $indice = ($pagina_atual - 1) * $limite;
                $dados["paginas"] = $paginas;
                $dados["pagina_atual"] = $pagina_atual;
                $dados['metodo_buscar'] = $parametros;
                $sql .= " ORDER BY id DESC  LIMIT $indice,$limite ";

                $dados['categorias'] = $crud->read($sql);
            }
            $this->loadTemplate($viewName, $dados);
        } else {
            $url = "location: " . BASE_URL . "home";
            header($url);
        }
    }

    public function post($page = 1) {
        if ($this->checkUser()) {
            $viewName = "post/relatorio";
            $crud = new crud_db();
            $dados = array();
            $dados['categorias'] = $crud->read("SELECT * FROM categoria WHERE status = 1 ORDER BY nome ASC");
            $dados['usuarios'] = $crud->read("SELECT * FROM usuario WHERE status = 1 ORDER BY nome ASC");
            $arraySearch = array();
            $sql = "SELECT p.*, c.nome as categoria, u.nome FROM post AS p INNER JOIN categoria as c INNER JOIN usuario as u WHERE p.id_categoria=c.id AND  p.id_usuario=u.id ";
            $parametros = "";
            if (isset($_GET['nBuscarBT'])) {
                $parametros = "?nCategoria=" . $_GET['nCategoria'] . "?nUsuario=" . $_GET['nUsuario'] . "?nTitulo=" . $_GET['nTitulo'] . "&nBuscarBT=BuscarBT";
                //nTitulo
                if (!empty($_GET['nCategoria'])) {
                    $sql = $sql . " AND id_categoria=:categoria ";
                    $arraySearch['categoria'] = addslashes($_GET['nCategoria']);
                }
                //nTitulo
                if (!empty($_GET['nUsuario'])) {
                    $sql = $sql . " AND id_usuario=:id_usuario ";
                    $arraySearch['id_usuario'] = addslashes($_GET['nUsuario']);
                }
                //nTitulo
                if (!empty($_GET['nTitulo'])) {
                    $sql = $sql . " AND titulo LIKE :titulo ";
                    $arraySearch['titulo'] = "%" . $_GET['nTitulo'] . "%";
                }
                //paginacao
                $limite = 10;
                $total_registro = $crud->read($sql, $arraySearch);
                $total_registro = is_array($total_registro) ? count($total_registro) : 1;
                $paginas = $total_registro / $limite;
                $indice = 0;
                $pagina_atual = (isset($page) && !empty($page)) ? addslashes($page) : 1;
                $indice = ($pagina_atual - 1) * $limite;
                $dados["paginas"] = $paginas;
                $dados["pagina_atual"] = $pagina_atual;
                $dados['metodo_buscar'] = $parametros;
                $sql .= " ORDER BY p.id DESC LIMIT $indice,$limite ";

                $dados['slides'] = $crud->read($sql, $arraySearch);
            } else {
                //paginacao
                $limite = 10;
                $total_registro = $crud->read($sql);
                $total_registro = is_array($total_registro) ? count($total_registro) : 1;
                $paginas = $total_registro / $limite;
                $indice = 0;
                $pagina_atual = (isset($page) && !empty($page)) ? addslashes($page) : 1;
                $indice = ($pagina_atual - 1) * $limite;
                $dados["paginas"] = $paginas;
                $dados["pagina_atual"] = $pagina_atual;
                $dados['metodo_buscar'] = $parametros;
                $sql .= " ORDER BY p.id DESC LIMIT $indice,$limite ";

                $dados['slides'] = $crud->read($sql);
            }
            $this->loadTemplate($viewName, $dados);
        } else {
            $url = "location: " . BASE_URL . "home";
            header($url);
        }
    }

}
