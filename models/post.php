<?php

/**
 * A classe 'usuario' é responsável para efetiva comandos sql no banco de dados, como, insert, update, select, delete, count;
 * 
 * @author Joab Torres <joabtorres1508@gmail.com>
 * @version 1.0
 * @copyright  (c) 2019, Joab Torres Alencar - Analista de Sistemas 
 * @access public
 * @package models
 * @example classe usuario
 */
class post extends model {

    /**
     * String $numRows - referente q quantidade de linhas obtidas no select;
     * @access private
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    private $numRows;

    /**
     * Está função tem como objetivo retorna a quantidade de registro encontrados armazenados na variavel $numRows
     * @access public
     * @return int
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function getNumRows() {
        return $this->numRows;
    }

    /**
     * Está função é responsável para cadastrar novos registros;
     * @param String $sql_command  - Comando SQL;
     * @param Array $data - Dados salvo em array para seres setados por um foreach;
     * @access public
     * @return boolean 
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function create($data) {
        try {
            $sql = $this->db->prepare('INSERT INTO post(id, id_categoria, id_usuario, data, titulo, previo, texto, imagem, status) VALUES (:id, :id_categoria, :id_usuario, :data, :titulo, :previo, :texto, :imagem, :status)');
            $sql->bindValue(':id', $data['id']);
            $sql->bindValue(':id_categoria', $data['id_categoria']);
            $sql->bindValue(':id_usuario', $data['id_usuario']);
            $sql->bindValue(':data', $data['data']);
            $sql->bindValue(':titulo', $data['titulo']);
            $sql->bindValue(':previo', $data['previo']);
            $sql->bindValue(':texto', $data['texto']);
            if (!empty($data['imagem'])) {
                $sql->bindValue(':imagem', $this->save_image($data['imagem'], $data['id']));
            } else {
                $sql->bindValue(':imagem', null);
            }
            $sql->bindValue(':status', $data['status']);
            $sql->execute();
            if (isset($data['imagens']) && !empty($data['imagens'])) {
                //VERIFICANDO SE FOI SALVO O post
                $result = $this->read_specific('SELECT * FROM post WHERE id=:id', array('id' => $data['id']));
                if (is_array($result) && !empty($result)) {
                    foreach ($data['imagens'] as $imagem) {
                        $sql = $this->db->prepare("INSERT INTO post_img (id_post, imagem) VALUES (:id_post, :imagem)");
                        $sql->bindValue(":id_post", $data['id']);
                        $sql->bindValue(":imagem", $this->save_images_large($imagem, $data['id']));
                        $sql->execute();

                        $sql = $this->db->prepare("INSERT INTO post_img_min (id_post, imagem) VALUES (:id_post, :imagem)");
                        $sql->bindValue(":id_post", $data['id']);
                        $sql->bindValue(":imagem", $this->save_images_mini($imagem, $data['id']));
                        $sql->execute();
                    }
                }
            }
            return true;
        } catch (PDOException $ex) {
            echo '<script> alert("Mensagem: ' . $ex->getMessage() . '")</script>';
        }
    }

    /**
     * Está função é responsável para consultas no banco e retorna os resultados obtidos;
     * @param String $sql_command  - Comando SQL;
     * @param Array $data - Dados salvo em array para seres setados por um foreach;
     * @access public
     * @return array $sql->fetchAll() [caso encontre] | bollean FALSE [caso contrário] 
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function read($sql_command, $data) {
        if (!empty($data)) {
            $sql = $this->db->prepare($sql_command);

            foreach ($data as $indice => $valor) {
                $sql->bindValue(":" . $indice, $valor);
            }
            $sql->execute();
        } else {
            $sql = $this->db->query($sql_command);
        }
        if ($sql->rowCount() > 0) {
            $this->numRows = $sql->rowCount();
            return $sql->fetchAll();
        } else {
            $this->numRows = 0;
            return FALSE;
        }
    }

    /**
     * Está função é responsável para consultas no banco e retorna os resultados obtidos;
     * @param String $sql_command  - Comando SQL;
     * @param Array $data - Dados salvo em array para seres setados por um foreach;
     * @access public
     * @return array $sql->fetch() [caso encontre] | bollean FALSE [caso contrário] 
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function read_specific($sql_command, $data) {
        if (!empty($data)) {
            $sql = $this->db->prepare($sql_command);

            foreach ($data as $indice => $valor) {
                $sql->bindValue(":" . $indice, $valor);
            }
            $sql->execute();
        } else {
            $sql = $this->db->query($sql_command);
        }
        if ($sql->rowCount() > 0) {
            $this->numRows = $sql->rowCount();
            return $sql->fetch();
        } else {
            $this->numRows = 0;
            return FALSE;
        }
    }

    /**
     * Está função é responsável para altera um registro específico;
     * @param String $sql_command  - Comando SQL;
     * @param Array $data - Dados salvo em array para seres setados por um foreach;
     * @access public
     * @return bollean TRUE ou FALSE
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function update($data) {
        try {
            $sql = $this->db->prepare('UPDATE post SET id_categoria=:id_categoria, id_usuario=:id_usuario, data=:data, titulo=:titulo, previo=:previo, texto=:texto, imagem=:imagem, status=:status WHERE id=:id');
            $sql->bindValue(':id_categoria', $data['id_categoria']);
            $sql->bindValue(':id_usuario', $data['id_usuario']);
            $sql->bindValue(':data', $data['data']);
            $sql->bindValue(':titulo', $data['titulo']);
            $sql->bindValue(':previo', $data['previo']);
            $sql->bindValue(':texto', $data['texto']);
            if (is_array($data['imagem'])) {
                $this->delete_image($data['delete_imagem']);
                $sql->bindValue(':imagem', $this->save_image($data['imagem'], $data['id']));
            } else {
                $sql->bindValue(':imagem', $data['imagem']);
            }
            $sql->bindValue(':status', $data['status']);
            $sql->bindValue(':id', $data['id']);
            $sql->execute();

            $imagens_atual_no_form = array();
            if (isset($data['imagens']) && !empty($data['imagens'])) {
                foreach ($data['imagens'] as $imagem) {
                    if (isset($imagem['tmp_name'])) {
                        $imagens_atual_no_form['grande'][] = $this->save_images_large($imagem, $data['id']);
                        $imagens_atual_no_form['min'][] = $this->save_images_mini($imagem, $data['id']);
                    } else {
                        $imagens_atual_no_form['grande'][] = $imagem['grande'];
                        $imagens_atual_no_form['min'][] = $imagem['min'];
                    }
                }
                $img_grande = $imagens_atual_no_form['grande'];
                $img_min = $imagens_atual_no_form['min'];
                $this->uploadImgs($img_grande, "post_img", $data['id']);
                $this->uploadImgs($img_min, "post_img_min", $data['id']);
            } else {
                $this->exclirImgs(array('id' => $data['id']));
            }
            return $this->readPost(md5($data['id']));
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            return null;
        }
    }

    private function exclirImgs($data) {

        if (!empty($data)) {
            $imagens_grande = $this->read("SELECT * FROM post_img WHERE id_post=:id", array('id' => $data['id']));
            if (is_array($imagens_grande) && !empty($imagens_grande)) {
                foreach ($imagens_grande as $indice) {
                    $this->excluir_imagem($indice['imagem']);
                }
            }
            $imagens_min = $this->read("SELECT * FROM post_img_min WHERE id_post=:id", array('id' => $data['id']));
            if (is_array($imagens_min) && !empty($imagens_min)) {
                foreach ($imagens_min as $indice) {
                    $this->excluir_imagem($indice['imagem']);
                }
            }
            $this->excluir("DELETE FROM post_img_min WHERE id_post=:id", array('id' => $data['id']));
            $this->excluir("DELETE FROM post_img WHERE id_post=:id", array('id' => $data['id']));
            return true;
        } else {
            return false;
        }
    }

    private function uploadImgs($imagensDoForm, $tabela, $id_post) {
        $imagensDoBanco = $this->read("SELECT * FROM " . $tabela . " where id_post=:id", array('id' => $id_post));
        if (!empty($imagensDoBanco) && is_array($imagensDoBanco)) {
            if (count($imagensDoBanco) > 0) {
                $imagens_atual_no_bd = array();
                foreach ($imagensDoBanco as $indice) {
                    $imagens_atual_no_bd[] = $indice['imagem'];
                }
                //imagens que serao removidas
                $imagens_removida = array_diff($imagens_atual_no_bd, $imagensDoForm);
                //imagens diferentes da atual inseridas
                $imagensDoForm = array_diff($imagensDoForm, $imagens_atual_no_bd);
                array_multisort($imagens_removida);
                array_multisort($imagensDoForm);
                while (count($imagens_removida) >= count($imagensDoForm) && count($imagensDoForm) > 0) {
                    $this->excluir_imagem($imagens_removida[0]);
                    $sql = $this->db->prepare("UPDATE " . $tabela . "  SET imagem=:imagem WHERE id_post=:id and imagem=:img_removida");
                    $sql->bindValue(':imagem', $imagensDoForm[0]);
                    $sql->bindValue(':id', $id_post);
                    $sql->bindValue(':img_removida', $imagens_removida[0]);
                    $sql->execute();
                    array_shift($imagens_removida);
                    array_shift($imagensDoForm);
                }
                foreach ($imagens_removida as $imagem) {
                    $this->excluir_imagem($imagem);
                    $sql = $this->db->prepare("DELETE FROM " . $tabela . "  WHERE imagem=:imagem AND id_post=:id ");
                    $sql->bindValue(':imagem', $imagem);
                    $sql->bindValue(':id', $id_post);
                    $sql->execute();
                }
            }
        }
        foreach ($imagensDoForm as $imagem) {
            $sql = $this->db->prepare("INSERT INTO " . $tabela . "  (id_post, imagem) VALUES (:id, :imagem)");
            $sql->bindValue(":id", $id_post);
            $sql->bindValue(":imagem", $imagem);
            $sql->execute();
        }
    }

    //$id  em md5
    public function readPost($id) {
        $post = $this->read_specific("select * from post where md5(id)=:id", array('id' => $id));
        if (is_array($post)) {
            $imgs_grande = $this->read("SELECT * FROM post_img where id_post=:id", array('id' => $post['id']));
            $imgs_min = $this->read("SELECT * FROM post_img_min where id_post=:id", array('id' => $post['id']));
            if (is_array($imgs_min) && is_array($imgs_grande)) {
                foreach ($imgs_grande as $key => $value) {
                    $post['imagens'][$key]['grande'] = $value['imagem'];
                }
                foreach ($imgs_min as $key => $value) {
                    $post['imagens'][$key]['min'] = $value['imagem'];
                }
            }
        }
        return $post;
    }

    /**
     * Está é responsável excluir um registro específico
     * @param String $sql_command  - Comando SQL;
     * @param Array $data - Dados salvo em array para seres setados por um foreach;
     * @access private
     * @return boolean TRUE or FALSE
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    private function excluir($sql_command, $data) {
        $sql = $this->db->prepare($sql_command);
        foreach ($data as $indice => $valor) {
            $sql->bindValue(":" . $indice, $valor);
        }
        $sql->execute();
        return true;
    }

    /**
     * Está é responsável excluir um registro específico
     * @param String $sql_command  - Comando SQL;
     * @param Array $data - Dados salvo em array 
     * @access public
     * @return boolean TRUE or FALSE
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function remove($data) {
        if (!empty($data)) {
            $imagens_grande = $this->read("SELECT * FROM post_img WHERE id_post=:id", array('id' => $data['id']));
            if (is_array($imagens_grande) && !empty($imagens_grande)) {
                foreach ($imagens_grande as $indice) {
                    $this->excluir_imagem($indice['imagem']);
                }
            }
            $imagens_min = $this->read("SELECT * FROM post_img_min WHERE id_post=:id", array('id' => $data['id']));
            if (is_array($imagens_min) && !empty($imagens_min)) {
                foreach ($imagens_min as $indice) {
                    $this->excluir_imagem($indice['imagem']);
                }
            }
            $this->excluir_imagem($data['imagem']);
            $this->excluir("DELETE FROM post_img_min WHERE id_post=:id", array('id' => $data['id']));
            $this->excluir("DELETE FROM post_img WHERE id_post=:id", array('id' => $data['id']));
            $this->excluir("DELETE FROM post WHERE id=:id", array('id' => $data['id']));
            return true;
        } else {
            return false;
        }
    }

    /**
     * Está função é responsável para salva uma imágem no diretório uploads/usuarios/
     * @access public
     * @return boolean TRUE or FALSE
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    private function save_image($file, $id) {
        $imagem = array();
        $largura = 420;
        $altura = 229;
        $imagem['temp'] = $file['tmp_name'];
        $imagem['extensao'] = explode(".", $file['name']);
        $imagem['extensao'] = strtolower(end($imagem['extensao']));
        $imagem['name'] = md5(rand(1000, 900000) . time()) . '.' . $imagem['extensao'];
        $imagem['diretorio'] = 'uploads/posts/post_' . $id;
        if ($imagem['extensao'] == 'jpg' || $imagem['extensao'] == 'jpeg' || $imagem['extensao'] == 'png') {
            if (!file_exists($imagem['diretorio'])) {
                mkdir($imagem['diretorio'], 0777, TRUE);
            }
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

    private function save_images_large($file, $id) {
        $imagem = array();
        $largura = 1024;
        $altura = 768;
        $imagem['temp'] = $file['tmp_name'];
        $imagem['extensao'] = explode(".", $file['name']);
        $imagem['extensao'] = strtolower(end($imagem['extensao']));
        $imagem['name'] = 'normal_' . md5(rand(1000, 900000) . time()) . '.' . $imagem['extensao'];
        $imagem['diretorio'] = 'uploads/posts/post_' . $id;
        if ($imagem['extensao'] == 'jpg' || $imagem['extensao'] == 'jpeg' || $imagem['extensao'] == 'png') {
            if (!file_exists($imagem['diretorio'])) {
                mkdir($imagem['diretorio'], 0777, TRUE);
            }
            list($larguraOriginal, $alturaOriginal) = getimagesize($imagem['temp']);
            $ratio = $larguraOriginal / $alturaOriginal;
            if ($largura / $altura > $ratio) {
                $largura = $altura * $ratio;
            } else {
                $altura = $largura / $ratio;
            }

            $imagem_final = imagecreatetruecolor($largura, $altura);

            if ($imagem['extensao'] == 'jpg' || $imagem['extensao'] == 'jpeg') {
                $imagem_original = imagecreatefromjpeg($imagem['temp']);
                imagecopyresampled($imagem_final, $imagem_original, 0, 0, 0, 0, $largura, $altura, $larguraOriginal, $alturaOriginal);
                imagejpeg($imagem_final, $imagem['diretorio'] . "/" . $imagem['name'], 90);
            } else if ($imagem['extensao'] == 'png') {
                $imagem_original = imagecreatefrompng($imagem['temp']);
                imagecopyresampled($imagem_final, $imagem_original, 0, 0, 0, 0, $largura, $altura, $larguraOriginal, $alturaOriginal);
                imagepng($imagem_final, $imagem['diretorio'] . "/" . $imagem['name']);
            }
            return $imagem['diretorio'] . "/" . $imagem['name'];
        } else {
            return null;
        }
    }

    private function save_images_mini($file, $id) {
        $imagem = array();
        $largura = 420;
        $altura = 229;
        $imagem['temp'] = $file['tmp_name'];
        $imagem['extensao'] = explode(".", $file['name']);
        $imagem['extensao'] = strtolower(end($imagem['extensao']));
        $imagem['name'] = 'miniatura_' . md5(rand(1000, 900000) . time()) . '.' . $imagem['extensao'];
        $imagem['diretorio'] = 'uploads/posts/post_' . $id;
        if ($imagem['extensao'] == 'jpg' || $imagem['extensao'] == 'jpeg' || $imagem['extensao'] == 'png') {
            if (!file_exists($imagem['diretorio'])) {
                mkdir($imagem['diretorio'], 0777, TRUE);
            }
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

    /**
     * Está é responsável excluir uma imagem de usuário;
     * @param String $url_image - diretório do arquivo;
     * @access private
     * @return boolean TRUE or FALSE
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    private function delete_image($url_image) {
        if (file_exists($url_image)) {
            unlink($url_image);
        }
    }

    /*
     * function excluir_imagem($imagem)
     * Descrição: Está é uma função privada utilizada para remove uma imagem e remove o diretório caso não mais nenhum arquivos salvo
     * @param $imagem : É a url da imagem
     * @author Joab Torres Alencar
     */

    private function excluir_imagem($imagem) {
        if (file_exists($imagem)) {
            unlink($imagem);
            $nome_imagem = explode("/", $imagem);
            $nome_imagem = end($nome_imagem);
            $diretorio = explode("/" . $nome_imagem, $imagem);
            $diretorio = $diretorio[0];
            if (count(scandir($diretorio)) <= 2) {
                rmdir($diretorio);
            }
        }
    }

}
