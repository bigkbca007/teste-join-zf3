
/**
 * 
 * @param {object} options
 * @returns {void}
 */
function mostrarModal(options) {

    var borderColor;
    var icon = '';
    if ('undefined' == typeof options.title_icon) {
        options.title_icon = true;
    }

    switch (options.type) {
        case 'success':
            borderColor = 'solid 1px #28a745 !important;';
            if (options.title_icon) {
                icon = '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>';
            }
            break;
        case 'danger':
            borderColor = 'solid 1px #dc3545 !important;';
            if (options.title_icon) {
                icon = '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>';
            }
            break;
        case 'warning':
            borderColor = 'solid 1px #ffc107 !important;';
            if (options.title_icon) {
                icon = '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>';
            }
            break;
        case 'info':
            borderColor = 'solid 1px #17a2b8 !important;';
            if (options.title_icon) {
                icon = '<span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>';
            }
            break;
        default:
            borderColor = 'solid 1px #e5e5e5 !important;';
    }

    // Largura da janela madal.
    styleCenterWidth = '';
    if ('number' === typeof options.width) {
        var width = window.innerWidth * options.width;
        var marginLeft = width / 2;
        styleCenterWidth = 'width:' + width + 'px;left:50%;margin-left:-' + marginLeft + 'px;';
    }

    // Altura da janela modal.
    styleCenterHeight = '';
    //if ('number' === typeof options.height) {
    //    var height = window.innerHeight * options.height;
    //    //var marginTop = height / 2;
    //    var marginTop = 0;
    //    styleCenterHeight = 'height:' + height + 'px;top:50%;margin-top:-' + marginTop + 'px;';
    //}

    // Largura do corpo da janela madal.
    var styleWidthPx = '';
    //if ('number' === typeof options.width) {
    //    var widthBody = window.innerWidth * options.widthBody;
    //    styleWidthPx = 'width:' + widthBody + 'px;';
    //}

    // Altura do corpo da janela madal.
    var styleHeightPx = '';
    if ('number' === typeof options.height) {
        var heightBody = window.innerHeight * options.height;
        styleHeightPx = 'height:' + heightBody + 'px;';
    }

    // Barra de rolagem vertical no corpo
    var scrollY = '';
    if (options.scrollY) {
        scrollY = 'overflow-y: scroll;';
        if ('number' !== typeof options.height) {
            // Se não houver altura, então esta será 80% da altura da tela.
            var heightBody = window.innerHeight * .7;
            styleHeightPx = 'height:' + heightBody + 'px;';
        }
    }

    var htmlModal = criarModalMensagens();
    var modal = $(htmlModal);

    modal.find(".modal-content").attr('style', 'border: ' + borderColor + styleCenterWidth + styleCenterHeight);
    modal.find(".modal-header").attr('style', 'background-color:transparent !important; border-bottom: ' + borderColor);
    modal.find(".modal-header h5 strong").addClass("text-" + options.type).html(icon + ' ' + options.txt_header);
    modal.find("#bt-fechar").addClass("text-" + options.type);
    modal.find(".modal-body").addClass("text-" + options.type + " bg-" + options.type).attr('style', styleWidthPx + styleHeightPx + scrollY).html(options.txt_body);
    modal.find(".modal-footer").attr('style', 'border-top: ' + borderColor);

    // Atribui id
    if ('undefined' !== typeof options.id) {
        modal.attr('id', options.id);
    }

    // Cria os botões
    if ('undefined' !== typeof options.buttons) {
        modal.find(".modal-footer").html('');
        $.each(options.buttons, function (i, b) {
            var buttonEl = $('<button></buttons>');
            var btnType = 'undefined' === typeof b.type ? options.type : b.type;
            var btnText = 'undefined' === typeof b.text ? 'Button' : b.text;

            buttonEl.addClass('btn btn-' + btnType);
            buttonEl.html(btnText);

            // Adiciona os atributos
            if ('undefined' !== typeof b.attributes) {
                $.each(b.attributes, function (j, a) {
                    if ('class' == j) {
                        buttonEl.addClass(a);
                    } else {
                        buttonEl.attr(j, a);
                    }
                });
            }

            modal.find(".modal-footer").prepend(buttonEl);
        });
    } else {
        // Se não houver butão, adiciona o butão de fechar.
        var buttonEl = $('<button></buttons>');
        buttonEl.addClass('btn btn-default');
        buttonEl.html('Fechar');
        buttonEl.attr('data-dismiss', 'modal');
        modal.find(".modal-footer").prepend(buttonEl);
    }

    // Eventos
    // O evento padrão é shown.bs.modal
    if ('undefined' !== typeof options.event) {
        $.each(options.event, function (i, e) {
            var type = e.type ? e.type : 'shown.bs.modal';
            if ('undefined' !== typeof e.handler) {
                modal.one(type, e.handler);
            }
        });
    }

    // Destaca o campo com erro.
    if(options.selector_field_error){
        try{
            var el = $(options.selector_field_error);
            var label = el.closest('div').find('label');
            label.addClass('text-danger');
            el.addClass('border-input-error');
            el.one('focus', function(){
                label.removeClass('text-danger');
                el.removeClass('border-input-error');
            });
        } catch(e){
            console.error(e);
        }
        
    }
    
    modal.modal();

    // Remove o padding-right que gera quando as chamadas de modais se sobrepõem
    modal.one('hidden.bs.modal', function () {
        $('body').css({'padding-right': '0px'});
        modal.remove();
    });
    $('#scren-modal, .modal').one('hidden.bs.modal', function () {
        $('body').css({'padding-right': '0px'});
    });

}

function allModalClosed() {
    var allClosed = true;
    $.each($('.modal, #scren-modal'), function (i, m) {
        if ('undefined' != typeof $(m).data('bs.modal') && ($(m).data('bs.modal').isShown)) {
            allClosed = false;
        }
    });
    return allClosed;
}

function resetModalMsg() {
    var modal = $('.modal-sgp');
    modal.find(".modal-content").removeClass().addClass("modal-content");
    modal.find(".modal-header h5 strong").removeClass().html("");
    modal.find("#bt-fechar").removeClass().addClass("close");
    modal.find(".modal-body").removeClass().addClass("modal-body").html("");
    modal.find(".modal-footer #ok").removeClass().addClass("btn btn-primary").html("Ok").attr("ng-click", "");
    modal.find(".modal-footer #cancelar").html("Cancelar");
    modal.modal('hide');
}

function closeModalMsg(id) {
    if (id) {
        $('#' + id).modal('hide');
    } else {
        console.error('Erro: ID não definido. Se o modal não possui id, atribua-o um.');
    }
}

function criarModalMensagens() {

    var html = '';
    html += '<div class="modal fade modal-sgp" tabindex="-1" role="dialog">';
    html += '    <div class="modal-dialog" role="document">';
    html += '        <div class="modal-content">';
    html += '            <div class="modal-header">';
    html += '                <button type="button" class="close" id="bt-fechar" data-dismiss="modal" aria-label="Close">';
    html += '                    <span aria-hidden="true">&times;</span>';
    html += '                </button>';
    html += '                <h5 class="modal-title"><strong>Modal title</strong></h5>';
    html += '            </div>';
    html += '            <div class="modal-body">';
    html += '                <p>Modal body text goes here.</p>';
    html += '            </div>';
    html += '            <div class="modal-footer">';
    html += '            </div>';
    html += '        </div>';
    html += '    </div>';
    html += '</div>';

    return html;

}

/**
 * Função para mostrar mensagem "Carregando...".
 * @param string texto
 * @returns void
 */
function mostrarModalCarregando(texto) {
    var styleModalContent = 'text-align:center; border:none; background:transparent; margin-top:50%; box-shadow:0px 0px 0px transparent; color:#ffffff';
    var htmlModal = criarModalMensagens();
    var modal = $(htmlModal);
    var num;

    if ('undefined' === typeof $('body').data().nummodalcarregando) {
        $('body').data().nummodalcarregando = [];
        num = 0;
    } else if (0 === $('body').data().nummodalcarregando.length) {
        num = 0;
    } else {
        var num = $('body').data().nummodalcarregando[$('body').data().nummodalcarregando.length - 1] + 1;
    }
    $('body').data().nummodalcarregando.push(num);
    var id = 'modal-carregando-' + num;
    var txt = (texto || '' == texto) ? texto : 'Carregando...';

    modal
            .modal({
                backdrop: 'static',
                keyboard: false
            })
            .attr('id', id)
            .find('.modal-content')
            .attr('style', styleModalContent)
            .html('<h1>'+txt+'</h1>');

    modal.one('hidden.bs.modal', function () {
        var id = 'modal-carregando-' + $('body').data().nummodalcarregando.pop();
        $('#' + id).remove();
        $('body').css({'padding-right': '0px'});
    });
}

/**
 * Função para esconder mensagem "Carregando...".
 * @returns void
 */
function esconderModalCarregando() {
    var num = 'undefined' == (typeof $('body').data().nummodalcarregando) ? 0 : $('body').data().nummodalcarregando[$('body').data().nummodalcarregando.length - 1];
    var id = 'modal-carregando-' + num;

    $('#' + id).modal('hide');
}
