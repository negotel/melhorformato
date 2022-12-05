"use_strict"

$('#formImport').submit(function (e) {

    e.preventDefault();

    const formData = new FormData(document.getElementById('formImport'));
    formData.append("nomeRota", document.getElementById("nameExLarge").value);
    formData.append("codigo", document.getElementById("codigo").value);

    var table = document.getElementById("result-table");
    table.innerHTML = "";

    $.ajax({
        url: $(this).attr("action"),
        type: "POST",
        data: formData,
        dataType: 'json',
        processData: false,
        contentType: false,
        beforeSend: function () {
            $(".ajax_load")
                .fadeIn(200)
                .css("display", "flex")
                .find(".ajax_load_box_title")
                .text("Aguarde, enviando dados para o servido de processamento...");
        },
        success: function (resultado) {
            if(resultado.type === 'success') {

                const data =  resultado['data'];
                const chave_rota = resultado.data[0].codigo_rota;

                const data_guarda = { chave: chave_rota, nome_rota: document.getElementById("nameExLarge").value, registros : resultado['data'] };
                adicionar_rotas_storage(data_guarda)

                for (let i = 0; i < data.length; i++) {
                    var row = `<tr>
                                <td>${i + 1}</td>
                                <td>${data[i].descricao}</td>
                                <td>${data[i].endereco_completo}</td>
                                <td>${data[i].latitude}</td>
                                <td>${data[i].longitude}</td>
                                <td>
                                    <span class='text-nowrap'>
                                    <button type='button' class='btn btn-icon btn-info'>
                                    <span class='tf-icons bx bx-arrow-to-right'></span>
                                    </button>
                                    <button type='button' class='btn btn-icon btn-danger' id="remove">
                                        <span class='tf-icons bx bx-trash'></span>
                                    </button>
                                    </span>
                                </td>
                           </tr>`;
                    table.innerHTML += row;
                }

                menu_minhas_rotas();
                name_route_init(true);

                $(".ajax_load").fadeOut(200);
                document.getElementById('formImport').reset();
            }else {

                triggerModal({
                    icon: resultado.type === 'error' ? 'bx-shocked' : 'bx-smile',
                    message: resultado.message,
                    color: resultado.type === 'error' ? 'red' : 'green',
                    title: resultado.type === 'error' ? 'Ops, Algo de errado' : 'Sucesso',
                    button: false,
                    next_page: null
                })

                $(".ajax_load").fadeOut(200);
            }
        },
        error: function (e) {
            $(".ajax_load").fadeOut(200);
            if (e.status === 500) {
                return false;
            }
            document.getElementById('formImport').reset();
        }
    });
    return false;
});

$("table").on("click", "#remove", function (e) {
    $(this).closest('tr').remove();
})

