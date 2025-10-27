class SquallModal{
    constructor() {
        this.titulo_modal = "Modal";
        this.id_modal = "modal_gerado_por_squall_modal";
        this.id_conteudo_modal = "div_modal_gerado_squall";
        this.tamanho_modal = "mw-900px";
        this.url = "";
        this.botao_salvar = '<button type="button" class="btn btn-primary">Salvar</button>\n';
        this.botao_fechar = '<button type="button" class="btn btn-light" data-bs-dismiss="modal">Fechar</button>\n';
        this.botao_adicional = '';
        this.toPost = {};
    }

    Gerar (){
        let html = '<div class="modal  fade" tabindex="-1" id="'+this.id_modal+'">\n' +
            '    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered '+this.tamanho_modal+'">\n' +
            '        <div class="modal-content shadow-none">\n' +
            '            <div class="modal-header">\n' +
            '                <h5 class="modal-title">'+this.titulo_modal+'</h5>\n' +
            '\n' +
            '                <!--begin::Close-->\n' +
            '                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">\n' +
            '                    <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>\n' +
            '                </div>\n' +
            '                <!--end::Close-->\n' +
            '            </div>\n' +
            '\n' +
            '            <div class="modal-body" id="'+this.id_conteudo_modal+'">\n' +
            '            </div>\n' +
            '\n' +
            '            <div class="modal-footer">\n' +
                            this.botao_fechar + this.botao_salvar + this.botao_adicional +
            '            </div>\n' +
            '        </div>\n' +
            '    </div>\n' +
            '</div>';
        $('#'+this.id_modal).remove();
        $('body').append(html);
        $('#'+this.id_modal).modal('show',{backdrop: 'static', keyboard: false});

        if(this.url != "")
        {
            $('#' + this.id_conteudo_modal).load(this.url,this.toPost);
        }

    }
}