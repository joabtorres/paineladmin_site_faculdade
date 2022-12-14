<div class="container-fluid" id="form-slide">
    <div class="row">
        <div class="col-xs-12" id="pagina-header">
            <h3>Editar Slide</h3>
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
                <input type="hidden" name="nId" value="<?php echo!empty($slide['id']) ? $slide['id'] : 0; ?>"/>
                <section class="panel panel-black">
                    <header class="panel-heading">
                        <h4 class="panel-title"><i class="fa fa-circle-notch pull-left"></i>Slide</h4>
                    </header>
                    <article class="panel-body">
                        <div class="row">

                            <div class="col-md-9 form-group">
                                <label for="iNome">Link: </label>
                                <input type="text" class="form-control" name="nLink" id="iNome" value="<?php echo (!empty($slide['link'])) ? $slide['link'] : ''; ?>"/>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="iStatus" class="control-label">Status:</label><br/>
                                <select id="iStatus" name="nStatus" class="form-control single-select">

                                    <?php
                                    $array = array('Indisponível', 'Disponível');
                                    for ($i = 0; $i < count($array); $i++) {
                                        if ($i == $slide['status']) {
                                            echo '<option value="' . $i . '" selected>' . $array[$i] . '</option>';
                                        } else {
                                            echo '<option value="' . $i . '">' . $array[$i] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-offset-2 col-md-8">
                                <div class="text-center" id="fotos">
                                    <img src="<?php echo!empty($slide['imagem']) ? BASE_URL . $slide['imagem'] : BASE_URL . 'assets/imagens/modelo_slide.jpg' ?>" class="img-center img-responsive" alt="Usuario" id="viewImagem"/>
                                    <p class="text-center text-danger" style="margin-top: 6px">Observação: A dimensão da imagem é de 1400px de largura x 510px de altura (1400x510).</p>
                                    <label class="btn btn-success" for="cFileImagem">Selecionar Imagem</label>
                                    <input type="file" name="tImagem" id="cFileImagem" onchange="readURL(this)" class="hide"/>
                                    <input type="hidden" name="qtd_fotos" value="1">
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