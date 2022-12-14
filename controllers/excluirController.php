<?php

class excluirController extends controller {

    public function index() {
        $this->loadView('404');
    }

    public function usuario($id) {
        if ($this->checkUser()) {
            $crudModel = new crud_db();
            $userModel = new usuario();
            $resultado = $crudModel->read("SELECT * FROM post WHERE md5(id_usuario)=:cod", array('cod' => addslashes($id)));
            if (is_array($resultado) && !empty($resultado)) {
                $postModel = new post();
                foreach ($resultado as $post) {
                    $postModel->remove($post);
                }
            }
            if ($userModel->remove(array('id' => $id))) {
                $url = "location: " . BASE_URL . "consultar/usuario/1";
                header($url);
            }
        } else {
            $url = "location: " . BASE_URL . "home";
            header($url);
        }
    }

    public function slide($id) {
        if ($this->checkUser()) {
            $crudModel = new crud_db();
            $resultado = $crudModel->read_specific("SELECT * FROM slide WHERE md5(id)=:cod", array('cod' => addslashes($id)));
            if (is_array($resultado) && !empty($resultado)) {
                $crudModel->delete_file($resultado['imagem']);
            } else {
                $url = "location: " . BASE_URL . "consultar/categoria/1";
                header($url);
            }
            if ($crudModel->remove("DELETE FROM slide WHERE id=:id", array('id' => $resultado['id']))) {
                $url = "location: " . BASE_URL . "consultar/slide/1";
                header($url);
            }
        } else {
            $url = "location: " . BASE_URL . "home";
            header($url);
        }
    }

    public function categoria($id) {
        if ($this->checkUser()) {
            $crudModel = new crud_db();
            $resultado = $crudModel->read("SELECT * FROM post WHERE md5(id_categoria)=:cod", array('cod' => addslashes($id)));
            if (is_array($resultado) && !empty($resultado)) {
                $postModel = new post();
                foreach ($resultado as $post) {
                    $postModel->remove($post);
                }
            }
            if ($crudModel->remove("DELETE FROM categoria WHERE md5(id)=:id", array('id' => addslashes($id)))) {
                $url = "location: " . BASE_URL . "consultar/categoria/1";
                header($url);
            }
        } else {
            $url = "location: " . BASE_URL . "home";
            header($url);
        }
    }

    public function post($id) {
        if ($this->checkUser()) {
            $postModal = new post();
            $resultado = $postModal->read_specific("SELECT * FROM post WHERE md5(id)=:cod", array('cod' => addslashes($id)));
            if (is_array($resultado) && !empty($resultado)) {
                if ($postModal->remove($resultado)) {
                    $url = "location: " . BASE_URL . "consultar/post/1";
                    header($url);
                }
            } else {
                $url = "location: " . BASE_URL . "consultar/post/1";
                header($url);
            }
        }
    }

}
