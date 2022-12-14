<div  class="container-fluid" id="section-relatorio_reserva">
    <div class="row" >
        <div class="col-sm-12 col-md-12 col-lg-12" id="pagina-header">
            <h3>Slide</h3>
        </div>
    </div>
    <!--FIM pagina-header-->
    <div class="row">
        <div class="col-md-12 clear">
            <form method="GET" autocomplete="off" action="<?php echo BASE_URL ?>consultar/slide/1">
                <section class="panel panel-black">
                    <header class="panel-heading">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            <h4 class="panel-title"><i class="fa fa-search pull-left"></i> Painel de busca <i class="fa fa-eye pull-right"></i></h4> </a>
                    </header>
                    <div id="collapseOne" class="panel-collapse collapse">
                        <article class="panel-body">
                            <div class="row">

                                <div class="col-md-3 col-lg-2 form-group">
                                    <label for="iStatus" class="control-label">Status:</label><br/>
                                    <select id="iStatus" name="nStatus" class="form-control single-select">
                                        <option value="" selected="selected">Todas</option>
                                        <option value="Disponível" >Disponível</option>
                                        <option value="Indisponível" >Indisponível</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3 col-lg-5"><br>
                                    <button type="submit" name="nBuscarBT" value="BuscarBT" class="btn btn-warning"><i class="fa fa-search pull-left"></i> Buscar</button>
                                </div>
                            </div>
                            <div class="row">

                            </div>
                        </article>
                    </div>
                </section>
            </form>
        </div>
    </div>
    <?php
    if (!empty($slides)) {
        ?>
        <?php
        $qtd = 0;
        $numSlide = count($slides);
        foreach ($slides as $indice):
            ++$qtd;
            if ($qtd == 1) {
                echo '  <div class="row">';
            }
            ?>
            <div class="col-md-4">
                <div class="thumbnail">
                    <img src="<?php echo BASE_URL . $indice['imagem'] ?>" class="img-responsive"/>
                    <p>Slide: <?php echo $numSlide ?></p>
                    <p>Url: <?php echo $indice['link'] ?></p>
                    <div class="caption">
                        <?php echo!empty($indice['status']) ? '<span class="bg-success btn-block padding-5">Disponível</span>' : '<span class="bg-danger btn-block padding-5">Indisponível</span>' ?>
                        <a class="btn btn-primary btn-xs btn-block" href="<?php echo BASE_URL . 'editar/slide/' . md5($indice['id']); ?>" title="Editar"><i class="fa fa-pencil-alt"></i> Editar</a> 
                        <button type="button"  class="btn btn-danger btn-xs  btn-block" data-toggle="modal" data-target="#modal_relatorio_<?php echo md5($indice['id']) ?>" title="Excluir"><i class="fa fa-trash"></i> Excluir</button>
                    </div>
                </div>
            </div>
            <?php
            $numSlide--;
            if ($qtd == 3) {
                echo ' </div>';
                $qtd = 0;
            }
        endforeach;
        if ($qtd > 0) {
            echo ' </div>';
        }
        ?>
        <?php
    } else {
        echo '<div class="row"><div class="col-md-12">
                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <i class="fa fa-times"></i> Desculpe, não foi possível localizar nenhum registro !
                    </div>
                </div>
                </div>';
    }
    ?>
    <!--inicio da paginação-->
    <?php
    if (isset($paginas) && ceil($paginas) > 1) {
        ?>
        <div class = "row">
            <div class = "col-sm-12 col-md-12 col-lg-12">
                <ul class = "pagination">
                    <?php
                    echo "<li><a href='" . BASE_URL . "consultar/slide/1" . $metodo_buscar . "'>&laquo;</a></li>";
                    for ($p = 0; $p < ceil($paginas); $p++) {
                        if ($pagina_atual == ($p + 1)) {
                            echo "<li class='active'><a href='" . BASE_URL . "consultar/slide/" . ($p + 1) . $metodo_buscar . "'>" . ($p + 1) . "</a></li>";
                        } else {
                            echo "<li><a href='" . BASE_URL . "consultar/slide/" . ($p + 1) . $metodo_buscar . "'>" . ($p + 1) . "</a></li>";
                        }
                    }
                    echo "<li><a href='" . BASE_URL . "consultar/slide/" . ceil($paginas) . $metodo_buscar . "'>&raquo;</a></li>";
                    ?>
                </ul>
            </div> 
        </div> 

    <?php }
    ?>
    <!--fim da paginação-->
</div>

<?php
if (isset($slides) && is_array($slides)) :
    foreach ($slides as $indice) :
        ?>        
        <!--MODAL - ESTRUTURA BÁSICA-->
        <section class="modal fade" id="modal_relatorio_<?php echo md5($indice['id']) ?>" tabindex="-1" role="dialog">
            <article class="modal-dialog modal-md" role="document">
                <section class="modal-content">
                    <header class="modal-header bg-danger">
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 >Deseja remover este registro?</h4>
                    </header>
                    <article class="modal-body">
                        <ul class="list-unstyled">
                            <li><b>Imagem: </b></br> <img src="<?php echo!empty($indice['imagem']) ? BASE_URL . $indice['imagem'] : '' ?>" class="img-responsive"/></li>
                            <li><b>Status: </b><?php echo!empty($indice['status']) ? '<span class="bg-success ">Disponível</span>' : '<span class="bg-danger">Indisponível</span>' ?></li>

                        </ul>
                        <p class="text-justify text-danger"><span class="font-bold">OBS : </span> Ao clicar em "Excluir", este registro e todos registos relacionados ao mesmo deixaram de existir no sistema.</p>
                    </article>
                    <footer class="modal-footer">
                        <a class="btn btn-danger pull-left" href="<?php echo BASE_URL . 'excluir/slide/' . md5($indice['id']) ?>"> <i class="fa fa-trash"></i> Excluir</a> 
                        <button class="btn btn-default" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Fechar</button>
                    </footer>
                </section>
            </article>
        </section>
        <?php
    endforeach;
endif;
?>