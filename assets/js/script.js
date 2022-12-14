/**
 *
 * @author Joab Torres Alencar
 * @description Só carrega o conteudo da página após seu total carregamento
 */
function mostrarConteudo() {
    var elemento = document.getElementById("tela_load");
    elemento.style.display = "none";
    var elemento = document.getElementById("tela_sistema");
    if (elemento) {
        elemento.style.display = "block";
    }

    var elemento = document.getElementById("interface_login");
    if (elemento) {
        elemento.style.display = "block";
    }
}



/**
 * @author Joab Torres Alencar
 * @description para tratamento de preenchimento de campos
 */
$(document).ready(function () {
    mostrarConteudo();
    $('.input-data').mask("99/99/9999");
    $('.input-cpf').mask("999.999.999-99");
    $('.input-hora').mask("99:99:00");
    $('[data-toggle="popover"]').popover({html: true});
    $('[data-toggle="popover"]').on("click", function () {
        $(this).popover('show');
    });
    //oculta o arlert de mensagem
    $("[data-hide]").on("click", function () {
        $("#alert-msg").toggle().addClass('oculta');
    });

});
$(function () {
    $(".input-calendario").datepicker({
        changeYear: true,
        changeMonth: true,
        dateFormat: 'dd/mm/yy'
    });
});
/**
 * @author Joab Torres Alencar
 * @description Está função submite o forumlário de buscar rápida que está no menu da direita
 */
function submit_form_navbar() {
    if (document.nSearchSGL) {
        document.nSearchSGL.submit();
    }
}



//home
if (document.getElementById("form-post")) {
    /**
     * @author Joab Torres <joabtorres1508@gmail.com>
     * @description Este codigo abaixo é responsável para fazer o carregamento da imagem setada pelo usuário ao muda a foto do perfil
     */
    readURL1 = function (input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#viewImagem").attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    };
    tinymce.init({
        selector: 'textarea#iPost'
    });
}

//laboratorio
$(document).ready(function () {
    $('.single-select').select2({
        placeholder: "Selecione",
        width: '100%',
        allowClear: true
    });
});
function select2() {
    var tag = document.getElementsByClassName("js-example-basic-single");
    if (tag[0]) {
        $(document).ready(function () {
            $('.js-example-basic-single').select2({
                placeholder: "Selecione",
                allowClear: true,
                width: '100%'
            });
        });
    }
}

function FormataStringData(data) {
    var dia = data.split("/")[0];
    var mes = data.split("/")[1];
    var ano = data.split("/")[2];

    return ano + '-' + ("0" + mes).slice(-2) + '-' + ("0" + dia).slice(-2);
    // Utilizo o .slice(-2) para garantir o formato com 2 digitos.
}

//form slide
if (document.getElementById("form-slide")) {
    readURL = function (input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#viewImagem").attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    };
}
//administrador / usuario
if (document.getElementById("container-usuario-form")) {
    /**
     * @author Joab Torres <joabtorres1508@gmail.com>
     * @description Este codigo abaixo é responsável para fazer o carregamento da imagem setada pelo usuário ao muda a foto do perfil
     */
    readURL = function (input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#viewImagem").attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    };
    /**
     * @author Joab Torres <joabtorres1508@gmail.com>
     * @description Este codigo abaixo é responsável para fazer o carregamento da imagem setada pelo usuário ao muda a foto do perfil
     */
    readDefaultURL = function () {
        $("#viewImagem").attr('src', base_url + 'assets/imagens/user.png');
        if ($("#imagemStatus").val() === '0') {
            $("#imagemStatus").val('1');
        }
    };

}


/**
 * Adicionando novo campo para foto do imóvel
 */
if (document.getElementById("lista-de-imagem")) {
    qtdImagem = function () {
        var qtd = $(".viewFotos").filter(function (idx) {
            return $(this);
        }).length;
        document.getElementById("qnt_fotos").innerHTML = qtd;
        document.getElementById("iQnt_fotos").value = qtd;
    };
    /**
     * Função add_imagem
     */
    add_imagem = function () {
        var qtd = $(".viewFotos").filter(function (idx) {
            return $(this);
        }).length;
        qtd++;
        var fotos = document.getElementsByClassName('viewFotos');
        if (fotos.length > 0) {

            container = document.querySelector("#lista-de-imagem");
            div = document.createElement("div");
            div.setAttribute("class", "form-group col-md-3 container-foto");
            div.setAttribute("id", "foto-" + qtd);
            figure = document.createElement("figure");
            figure.setAttribute("class", "viewFotos");
            p = document.createElement("p");
            p.setAttribute("class", "font-bold");
            p.appendChild(document.createTextNode("Imagem - " + qtd));
            img = document.createElement("img");
            img.setAttribute("src", base_url + 'assets/imagens/imgs_post.png');
            img.setAttribute("id", "viewImagem-" + qtd);
            img.setAttribute("alt", "Imagem");
            img.setAttribute('class', 'img-center img-responsive');
            figcaption = document.createElement("figcaption");
            label = document.createElement("label");
            label.setAttribute("for", "cImagem-" + qtd);
            label.setAttribute("class", "btn btn-success btn-block magin-bottom-5");
            label.appendChild(document.createTextNode("Selecionar Imagem"));
            input = document.createElement("input");
            input.setAttribute("type", "file");
            input.setAttribute("name", "tImagem-" + qtd);
            input.setAttribute("id", "cImagem-" + qtd);
            input.setAttribute("class", "hide");
            input.setAttribute("onchange", "readURL(this);");
            span = document.createElement('span');
            span.setAttribute('class', 'btn btn-danger btn-block ');
            span.setAttribute('onclick', 'remover_foto(this);');
            span.appendChild(document.createTextNode('Remover'));
            figcaption.appendChild(label);
            figcaption.appendChild(input);
            figcaption.appendChild(span);
            figure.appendChild(p);
            figure.appendChild(img);
            figure.appendChild(figcaption);
            div.appendChild(figure);
            container.insertBefore(div, container.firstElementChild);
        } else {
            var imagem = document.getElementById("lista-de-imagem");
            imagem.innerHTML = imagem.innerHTML + '<div class="form-group col-md-3 container-foto" id="foto-1"> <figure class="viewFotos" > <p class="font-bold">Imagem - 1</p><img src="' + base_url + 'assets/imagens/imgs_post.png" alt="Imagem" id="viewImagem-1" class="img-center img-responsive"/><figcaption> <label for="cImagem-1" class="btn btn-success btn-block magin-bottom-5">Selecionar Imagem</label> <input type="file" id="cImagem-1" class="hide" name="tImagem-1" onchange="readURL(this);"/> <span class="btn btn-danger btn-block" onclick="remover_foto(this);">Remover</span> </figcaption> </figure> </div>';
        }
        qtdImagem();
    };
    readURL = function (input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            var num = input.name.replace("tImagem-", "");
            reader.onload = function (e) {
                $("#viewImagem-" + num).attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    };
    remover_foto = function (obj) {
        var foto = $(obj).parents('.container-foto').attr('id');
        $('#' + foto).remove();
        qtdImagem();
    };
}


















if (document.getElementById("container-reserva")) {
    var categoria = null;

    $(document).ready(function () {
        consultaHorario();
        validar_data();
        $("#selectUser").change(function () {
            consultaHorario();
        });
        $("#iLaboratorio").change(function () {
            consultaHorario();
        });
        $("#cDataFinal").change(function () {
            validar_data();
        });
        $("#cDataInicial").change(function () {
            validar_data();
        });
    });

    function validar_data() {
        var dateInicial = new Date(FormataStringData($("#cDataInicial").val()));
        if (document.getElementById("cDataFinal")) {
            var dateFinal = new Date(FormataStringData($("#cDataFinal").val()));
        } else {
            var dateFinal = new Date(FormataStringData($("#cDataInicial").val()));
        }
        if (dateFinal.getTime() > dateInicial.getTime()) {
            $("#iDiasdaSemana").addClass("show");
            $("#iDiasdaSemana").removeClass("hide");
            $("#iSegunda").removeAttr('disabled');
            $("#iTerca").removeAttr('disabled');
            $("#iQuarta").removeAttr('disabled');
            $("#iQuinta").removeAttr('disabled');
            $("#iSexta").removeAttr('disabled');
            $("#iSAb").removeAttr('disabled');

        } else {
            $("#iDiasdaSemana").addClass("hide");
            $("#iDiasdaSemana").removeClass("show");
            $("#iSegunda").attr("disabled", 'disabled');
            $("#iTerca").attr("disabled", 'disabled');
            $("#iQuarta").attr("disabled", 'disabled');
            $("#iQuinta").attr("disabled", 'disabled');
            $("#iSexta").attr("disabled", 'disabled');
            $("#iSAb").attr("disabled", 'disabled');
        }
    }
    function consultaHorario() {
        var dados = new Object();
        dados['id_usuario'] = $("#selectUser").val();
        dados['id_lab'] = $("#iLaboratorio").val();
        $.ajax({
            url: base_url + 'cadastrar/getHorario',
            type: 'POST',
            data: dados,
            dataType: 'json',
            success: function (resultado) {
                $("#iHorario").empty();
                var qtd = 0;
                if (resultado.length >= 0) {

                    for (i = 0; i < resultado.length; i++) {
                        categoria = resultado[i].categoria;
                        switch (resultado[i].categoria) {
                            case 'Aluno(a)':
                                ocultaTurma(true);
                                ocultarSabado();
                                if (resultado[i].intervalo <= 7200) {
                                    qtd++;
                                    if (typeof nHorario != 'undefined') {
                                        var hora = resultado[i].hora_inicial + ' - ' + resultado[i].hora_final;
                                        if (nHorario == hora) {
                                            $("#iHorario").append('<option value="' + resultado[i].hora_inicial + ' - ' + resultado[i].hora_final + '" selected="selected">' + resultado[i].hora_inicial + ' - ' + resultado[i].hora_final + '</option>');
                                        } else {
                                            $("#iHorario").append('<option value="' + resultado[i].hora_inicial + ' - ' + resultado[i].hora_final + '">' + resultado[i].hora_inicial + ' - ' + resultado[i].hora_final + '</option>');
                                        }
                                    } else {
                                        $("#iHorario").append('<option value="' + resultado[i].hora_inicial + ' - ' + resultado[i].hora_final + '">' + resultado[i].hora_inicial + ' - ' + resultado[i].hora_final + '</option>');
                                    }
                                }
                                break;
                            case 'Professor(a)':
                                ocultaTurma(false);
                                qtd++;
                                if (typeof nHorario != 'undefined') {
                                    var hora = resultado[i].hora_inicial + ' - ' + resultado[i].hora_final;
                                    if (nHorario == hora) {
                                        $("#iHorario").append('<option value="' + resultado[i].hora_inicial + ' - ' + resultado[i].hora_final + '" selected="selected">' + resultado[i].hora_inicial + ' - ' + resultado[i].hora_final + '</option>');
                                    } else {
                                        $("#iHorario").append('<option value="' + resultado[i].hora_inicial + ' - ' + resultado[i].hora_final + '">' + resultado[i].hora_inicial + ' - ' + resultado[i].hora_final + '</option>');
                                    }
                                } else {
                                    $("#iHorario").append('<option value="' + resultado[i].hora_inicial + ' - ' + resultado[i].hora_final + '">' + resultado[i].hora_inicial + ' - ' + resultado[i].hora_final + '</option>');
                                }
                                break;
                            default:
                                ocultaTurma(true);
                                qtd++;
                                if (typeof nHorario != 'undefined') {
                                    var hora = resultado[i].hora_inicial + ' - ' + resultado[i].hora_final;
                                    if (nHorario == hora) {
                                        $("#iHorario").append('<option value="' + resultado[i].hora_inicial + ' - ' + resultado[i].hora_final + '" selected="selected">' + resultado[i].hora_inicial + ' - ' + resultado[i].hora_final + '</option>');
                                    } else {
                                        $("#iHorario").append('<option value="' + resultado[i].hora_inicial + ' - ' + resultado[i].hora_final + '">' + resultado[i].hora_inicial + ' - ' + resultado[i].hora_final + '</option>');
                                    }
                                } else {
                                    $("#iHorario").append('<option value="' + resultado[i].hora_inicial + ' - ' + resultado[i].hora_final + '">' + resultado[i].hora_inicial + ' - ' + resultado[i].hora_final + '</option>');
                                }
                                break;
                        }
                    }
                }
                if (qtd > 0) {
                    $('#form-horario').removeClass('has-error');
                    $('#msgHorario').addClass('hide');
                    $('#msgHorario').removeClass('show-inline');
                } else {
                    $('#form-horario').addClass('has-error');
                    $('#msgHorario').addClass('show-inline');
                    $('#msgHorario').removeClass('hide');
                }

            }

        }
        );
    }
    function ocultarSabado() {
        $("#iSAb").attr("disabled", 'disabled');
    }
    function ocultaTurma(testeLogico) {
        if (testeLogico == true) {
            $('#iTurma').attr('disabled', 'disabled');
            $('#iDisciplina').attr('disabled', 'disabled');
            $('#turmasDisc').removeClass('show');
            $('#turmasDisc').addClass('hide');
        } else {
            $('#iTurma').removeAttr('disabled');
            $('#iDisciplina').removeAttr('disabled');
            $('#turmasDisc').removeClass('hide');
            $('#turmasDisc').addClass('show');
        }

    }


}