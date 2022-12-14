<div class="container-fluid" id="form-post">
    <div class="row">
        <div class="col-xs-12" id="pagina-header">
            <h3>Editar Post</h3>
        </div>
    </div> <!-- fim row-->
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="alert <?php echo (isset($erro['class'])) ? $erro['class'] : 'alert-warning'; ?> " role="alert" id="alert-msg">
                <button class="close" data-hide="alert">&times;</button>
                <div id="resposta"><?php echo (isset($erro['msg'])) ? $erro['msg'] : '<i class = "fa fa-info-circle" aria-hidden = "true"></i> Preencha os campos corretamente.'; ?></div>
            </div>
        </div>
        <div class="col-xs-12 clear">
            <form autocomplete="off" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="nId" value="<?php echo!empty($post['id']) ? $post['id'] : 0; ?>"/>
                <section class="panel panel-black">
                    <header class="panel-heading">
                        <h4 class="panel-title"><i class="fa fa-circle-notch pull-left"></i>Post</h4>
                    </header>
                    <article class="panel-body">
                        <div class="row">

                            <div class="form-group col-md-12 <?php echo (isset($post_erro['titulo']['class'])) ? $post_erro['titulo']['class'] : ''; ?>">
                                <label for="iTitulo" class="control-label">Título : * <?php echo (isset($post_erro['titulo']['msg'])) ? '<small><span class="glyphicon glyphicon-remove"></span> ' . $post_erro['titulo']['msg'] . ' </small>' : ''; ?></label>
                                <input type="text" name="nTitulo" id="iTitulo" class="form-control" placeholder="Exemplo: Vestibular 2020" value='<?php echo isset($post['titulo']) ? $post['titulo'] : ""; ?>'/>
                            </div>
                            <div class="col-md-3 form-group <?php echo (isset($post_erro['categoria']['class'])) ? $post_erro['categoria']['class'] : ''; ?>">
                                <label for="iCate" class="control-label">Categoria: *  <?php echo (isset($post_erro['categoria']['msg'])) ? '<small><span class="glyphicon glyphicon-remove"></span> ' . $post_erro['categoria']['msg'] . ' </small>' : ''; ?></label><br/>
                                <select id="iCate" name="nCategoria" class="form-control single-select">
                                    <?php
                                    foreach ($categorias as $indice) {
                                        if ($indice['id'] == $post['id_categoria']) {
                                            echo '<option value="' . $indice['id'] . '" selected>' . $indice['nome'] . '</option>';
                                        } else {
                                            echo '<option value="' . $indice['id'] . '">' . $indice['nome'] . '</option>';
                                        }
                                    }
                                    ?>

                                </select>
                            </div>
                            <div class="col-md-3 form-group <?php echo (isset($post_erro['autor']['class'])) ? $post_erro['autor']['class'] : ''; ?>">
                                <label for="iUsuario" class="control-label">Autor: *  <?php echo (isset($post_erro['autor']['msg'])) ? '<small><span class="glyphicon glyphicon-remove"></span> ' . $post_erro['autor']['msg'] . ' </small>' : ''; ?></label><br/>
                                <select id="iUsuario" name="nUsuario" class="form-control single-select">
                                    <?php
                                    foreach ($usuarios as $indice) {
                                        if ($indice['id'] == $post['id_usuario']) {
                                            echo '<option value="' . $indice['id'] . '" selected>' . $indice['nome'] . '</option>';
                                        } else {
                                            echo '<option value="' . $indice['id'] . '">' . $indice['nome'] . '</option>';
                                        }
                                    }
                                    ?>

                                </select>
                            </div>
                            <div class="form-group col-md-3 <?php echo (isset($post_erro['data']['class'])) ? $post_erro['data']['class'] : ''; ?>">
                                <label for="cData" class="control-label">Data: * <?php echo (isset($post_erro['data']['msg'])) ? '<small><span class="glyphicon glyphicon-remove"></span> ' . $post_erro['data']['msg'] . ' </small>' : ''; ?></label>
                                <input type="text" name="nData" id="cData" class="form-control input-data input-calendario" placeholder="Exemplo: 00/00/0000" value='<?php echo isset($post['data']) ? $this->formatDateView($post['data']) : date("d/m/Y"); ?>'/>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="iStatus" class="control-label">Status:</label><br/>
                                <select id="iStatus" name="nStatus" class="form-control single-select">

                                    <?php
                                    $array = array('Indisponível', 'Disponível');
                                    for ($i = 0; $i < count($array); $i++) {
                                        if ($i == $post['status']) {
                                            echo '<option value="' . $i . '" selected>' . $array[$i] . '</option>';
                                        } else {
                                            echo '<option value="' . $i . '">' . $array[$i] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-4 <?php echo (isset($post_erro['imagem']['class'])) ? $post_erro['imagem']['class'] : ''; ?>">
                                <label class="control-label">Imagem Destaque: * <?php echo (isset($post_erro['imagem']['msg'])) ? '<small><span class="glyphicon glyphicon-remove"></span> ' . $post_erro['imagem']['msg'] . ' </small>' : ''; ?></label>
                                <div class="text-center">
                                    <img src="<?php echo!empty($post['imagem']) ? BASE_URL . $post['imagem'] : BASE_URL . 'assets/imagens/img_post.png' ?>" class="img-center img-responsive" alt="Usuario" id="viewImagem"/>
                                    <label class="btn btn-success" for="cFileImagem">Selecionar Imagem</label>
                                    <input type="file" name="tImagem" id="cFileImagem" onchange="readURL1(this)" class="hide"/>
                                    <input type="hidden" name="qtd_fotos" value="1">
                                </div>
                            </div>
                            <div class="form-group col-md-8 <?php echo (isset($post_erro['previo']['class'])) ? $post_erro['previo']['class'] : ''; ?>">
                                <label class="control-label" id="iDescricao">Descrição Prévia : * <?php echo (isset($post_erro['previo']['msg'])) ? '<small><span class="glyphicon glyphicon-remove"></span> ' . $post_erro['previo']['msg'] . ' </small>' : ''; ?></label>
                                <textarea class="form-control" name="nDescricao" placeholder="Descrição previa (maximo 250 caracteres)" rows="8" maxlength="250"><?php echo!empty($post['previo']) ? $post['previo'] : '' ?></textarea>
                            </div>
                        </div>
                    </article>
                </section>
                <section class="panel panel-black">
                    <header class="panel-heading">
                        <h4 class="panel-title"><i class="fa fa-circle-notch pull-left"></i>Post</h4>
                    </header>
                    <article class="panel-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <textarea class="form-control" name="nPost" id="iPost" heigth="500px"><?php echo!empty($post['texto']) ? $post['texto'] : '' ?></textarea>
                            </div>
                        </div>
                    </article>
                </section>
                <section class="panel panel-black">
                    <header class="panel-heading">
                        <h4 class="panel-title"><i class="fa fa-circle-notch pull-left"></i>Imagens</h4>
                    </header>
                    <article class="panel-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="hidden" name="tQnt_fotos" value="<?php echo!empty($post['imagens']) ? count($post['imagens']) : 0 ?>" id="iQnt_fotos">
                                        <span class="btn btn-default" onclick="add_imagem();">Adicionar foto</span> <span>Quantidade de fotos atualmente: <span id="qnt_fotos"><?php echo!empty($post['imagens']) ? count($post['imagens']) : 0 ?></span></span>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="text-right text-success font-bold text-upercase">Aviso: ADICIONE em ordem crecente (menor para o maior)</p>
                                        <p class="text-right text-danger font-bold">Aviso: REMOVA em ordem decresente (maior para a menor)</p>
                                    </div>
                                </div>
                                <div id="lista-de-imagem">
                                    <?php
                                    if (!empty($post['imagens'])) :
                                        for ($i = count($post['imagens']); $i > 0; --$i):
                                            ?>
                                            <div class="form-group col-md-3 container-foto" id="foto-<?php echo $i ?>"> 
                                                <figure class="viewFotos"> <p class="font-bold">Imagem - <?php echo $i ?></p>
                                                    <img src="<?php echo BASE_URL . $post['imagens'][$i - 1]['min'] ?>" alt="Imagem" id="viewImagem-<?php echo $i ?>" class="img-center img-responsive">
                                                    <figcaption> 
                                                        <input type="hidden" name="nImagemMin-<?php echo $i ?>" value="<?php echo $post['imagens'][$i - 1]['min'] ?>" class="form-control">
                                                        <input type="hidden" name="nImagemLarge-<?php echo $i ?>" value="<?php echo $post['imagens'][$i - 1]['grande'] ?>" class="form-control">
                                                        <label for="cImagem-<?php echo $i ?>" class="btn btn-success btn-block magin-bottom-5">Selecionar Imagem</label> 
                                                        <input type="file" id="cImagem-<?php echo $i ?>" class="hide" name="tImagem-<?php echo $i ?>" onchange="readURL(this);"> 
                                                        <span class="btn btn-danger btn-block" onclick="remover_foto(this);">Remover</span> 
                                                    </figcaption> 
                                                </figure> 
                                            </div>
                                            <?php
                                        endfor;
                                    endif;
                                    ?>
                                </div>
                            </div>
                        </div>
                    </article>
                </section>
                <div class="row">
                    <div class="form-group col-xs-12">
                        <button type="submit" class="btn btn-success" name="nSalvar" value="Salvar"><i class="fa fa-check-circle" aria-hidden="true"></i> Salvar</button>
                        <a href="<?php echo BASE_URL ?>home" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div> <!-- fim row-->
</div>