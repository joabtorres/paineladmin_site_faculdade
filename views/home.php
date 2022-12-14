<div class="container-fluid" id="form-post">
    <div class="row">
        <div class="col-xs-12" id="pagina-header">
            <h3>Página Inicial</h3>
        </div>
    </div> <!-- fim row-->
    <div class="row">
        <div class="col-md-2 ">
            <div class="panel panel-black">
                <div class="panel-heading">
                    <h3 class="panel-title">Total de Slide</h3>
                </div>
                <div class="panel-body">
                    <?php echo !empty($qtd_slide) ? $qtd_slide['qtd'] : '0'?>
                </div>
            </div>
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Total de categorias</h3>
                </div>
                <div class="panel-body">
                     <?php echo !empty($qtd_categoria) ? $qtd_categoria['qtd'] : '0'?>
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Total de posts </h3>
                </div>
                <div class="panel-body">
                     <?php echo !empty($qtd_post) ? $qtd_post['qtd'] : '0'?>
                </div>
            </div>
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title">Total de Usuarios</h3>
                </div>
                <div class="panel-body">
                     <?php echo !empty($qtd_user) ? $qtd_user['qtd'] : '0'?>
                </div>
            </div>
        </div>
        <div class="col-md-10">
            <div class="panel panel-black">
                <div class="panel-heading">
                    <h3 class="panel-title">Manual do painel em conteúdo audiovisual</h3>
                </div>
                <div class="panel-body">
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-black">
                            <div class="panel-heading">
                                <a data-toggle="collapse" data-parent="#accordion" href="#panel-slide">
                                    <h4 class="panel-title">
                                        <i class="fa fa-share"></i> 1. Manual Audiovisual: Slide - (Cadastro, Consulta e Exclusão)
                                    </h4>
                                </a>
                            </div>
                            <div id="panel-slide" class="panel-collapse collapse ">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-xs-12 col-md-offset-2 col-md-8">                                            
                                            <h3 class="text-center">Slide - (Cadastro, Consulta e Exclusão);</h3>
                                            <div class="embed-responsive embed-responsive-16by9 " >
                                                <iframe src="https://www.youtube.com/embed/YA6aPMm26q4" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <a data-toggle="collapse" data-parent="#accordion" href="#panel-categoria">
                                    <h4 class="panel-title">
                                        <i class="fa fa-share"></i> 2. Manual Audiovisual: Categoria - (Cadastro, Consulta e Exclusão);
                                    </h4>
                                </a>
                            </div>
                            <div id="panel-categoria" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-xs-12 col-md-offset-2 col-md-8">
                                            <h3 class="text-center">Categoria - (Cadastro, Consulta e Exclusão)</h3>
                                            <div class="embed-responsive embed-responsive-16by9 " >
                                                <iframe  src="https://www.youtube.com/embed/BLOzs1qHudA" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>    
                                            </div>
                                            <hr/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <a data-toggle="collapse" data-parent="#accordion" href="#panel-post">
                                    <h4 class="panel-title">
                                        <i class="fa fa-share"></i> 3. Manual Audiovisual: Post - (Cadastro, Consulta e Exclusão);
                                    </h4>
                                </a>
                            </div>
                            <div id="panel-post" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-xs-12 col-md-offset-2 col-md-8">
                                            <h3 class="text-center">Post - (Cadastro, Consulta e Exclusão)</h3>
                                            <div class="embed-responsive embed-responsive-16by9 " >
                                                <iframe  src="https://www.youtube.com/embed/62lG5gzprWM" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>    
                                            </div>
                                            <hr/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-danger">
                            <div class="panel-heading">
                                <a data-toggle="collapse" data-parent="#accordion" href="#panel-usuario">
                                    <h4 class="panel-title">
                                        <i class="fa fa-share"></i> 4. Manual Audiovisual: Usuário - (Cadastro, Consulta e Exclusão);
                                    </h4>
                                </a>
                            </div>
                            <div id="panel-usuario" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-xs-12 col-md-offset-2 col-md-8">
                                            <h3 class="text-center ">Usuário - (Cadastro, Consulta e Exclusão)</h3>
                                            <div class="embed-responsive embed-responsive-16by9 " >
                                                <iframe  src="https://www.youtube.com/embed/TPkuKlWKBZM" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>    
                                            </div>
                                            <hr/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>