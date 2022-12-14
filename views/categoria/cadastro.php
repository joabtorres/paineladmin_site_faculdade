<div class="container-fluid" id="categoria">
    <div class="row">
        <div class="col-xs-12" id="pagina-header">
            <h3>Cadastrar Categoria</h3>
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
            <form autocomplete="off" method="POST">
                <input type="hidden" name="nId" value="<?php echo!empty($categoria['id']) ? $categoria['id'] : 0; ?>"/>
                <section class="panel panel-black">
                    <header class="panel-heading">
                        <h4 class="panel-title"><i class="fa fa-circle-notch pull-left"></i>Categoria</h4>
                    </header>
                    <article class="panel-body">
                        <div class="row">
                            <div class="col-md-9 form-group">
                                <label for="iNome">Nome da Categoria: *</label>
                                <input type="text" class="form-control" name="nNome" id="iNome" value="<?php echo (!empty($categoria['nome'])) ? $categoria['nome'] : ''; ?>"/>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="iStatus" class="control-label">Status:</label><br/>
                                <select id="iStatus" name="nStatus" class="form-control single-select">

                                    <?php
                                    $array = array('Indisponível', 'Disponível');
                                    for ($i = 0; $i < count($array); $i++) {
                                        if ($i == $categoria['status']) {
                                            echo '<option value="' . $i . '" selected>' . $array[$i] . '</option>';
                                        } else {
                                            if ($array[$i] == "Disponível") {
                                                echo '<option value="' . $i . '" selected>' . $array[$i] . '</option>';
                                            } else {
                                                echo '<option value="' . $i . '">' . $array[$i] . '</option>';
                                            }
                                        }
                                    }
                                    ?>
                                </select>
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