$(document).ready( function() 
{
    /* Executa a requisição quando o campo CEP perder o foco */
    $('#cep').blur(function()
    {
            /* Configura a requisição AJAX */
            $.ajax(
            {
                 url : BASE_URL + 'consultar_cep/consulta_cep', /* URL que será chamada */ 
                 type : 'POST', /* Tipo da requisição */ 
                 data: 'cep=' + $('#cep').val(), /* dado que será enviado via POST */
                 dataType: 'json', /* Tipo de transmissão */
                 success: function(data)
                 {
                     if(data.sucesso == 1)
                     {
                         $('#rua').val(data.rua)
                         $('#bairro').val(data.bairro)
                         $('#cidade').val(data.cidade)
                         $('#estado').val(data.estado)
  
                         $('#numero').focus()
                     }
                 }
            })
    return false
    })

    var dadosDatepicker = 
    {
        dateFormat: 'dd/mm/yy',
        changeMonth: true,
        changeYear: true,
        showOtherMonths: true,
        selectOtherMonths: true,
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
    }

    $('#data_vencimento').datepicker(dadosDatepicker)
    $('#data_pagamento').datepicker(dadosDatepicker)
 })

//  $(function() {
//     $("#data_vencimento" ).datepicker();
// });




// $(document).ready( ($) =>
// {
//     $("#cep").focusout( () =>
//     {
//         //Início do Comando AJAX
//         $.ajax(
//         {
//             //O campo URL diz o caminho de onde virá os dados
//             //É importante concatenar o valor digitado no CEP
//             url: 'https://viacep.com.br/ws/'+$(this).val()+'/json/unicode/',
//             //Aqui você deve preencher o tipo de dados que será lido,
//             //no caso, estamos lendo JSON.
//             dataType: 'json',
//             //SUCESS é referente a função que será executada caso
//             //ele consiga ler a fonte de dados com sucesso.
//             //O parâmetro dentro da função se refere ao nome da variável
//             //que você vai dar para ler esse objeto.
//             success: (res) =>
//             {
//                 //Agora basta definir os valores que você deseja preencher
//                 //automaticamente nos campos acima.
//                 $("#logradouro").val(res.logradouro);
//                 $("#complemento").val(res.complemento);
//                 $("#bairro").val(res.bairro);
//                 $("#cidade").val(res.localidade);
//                 $("#uf").val(res.uf);
//                 //Vamos incluir para que o Número seja focado automaticamente
//                 //melhorando a experiência do usuário
//                 $("#numero").focus();
//             }
//         })
//     })
// })

    // $("#cep").focusout( () =>
    // {
    //     //Início do Comando AJAX
    //     $.ajax(
    //     {
    //         //O campo URL diz o caminho de onde virá os dados
    //         //É importante concatenar o valor digitado no CEP
    //         url: 'https://viacep.com.br/ws/'+$(this).val()+'/json/unicode/',
    //         //Aqui você deve preencher o tipo de dados que será lido,
    //         //no caso, estamos lendo JSON.
    //         dataType: 'json',
    //         //SUCESS é referente a função que será executada caso
    //         //ele consiga ler a fonte de dados com sucesso.
    //         //O parâmetro dentro da função se refere ao nome da variável
    //         //que você vai dar para ler esse objeto.
    //         success: (res) =>
    //         {
    //             //Agora basta definir os valores que você deseja preencher
    //             //automaticamente nos campos acima.
    //             $("#logradouro").val(res.logradouro);
    //             $("#complemento").val(res.complemento);
    //             $("#bairro").val(res.bairro);
    //             $("#cidade").val(res.localidade);
    //             $("#uf").val(res.uf);
    //             //Vamos incluir para que o Número seja focado automaticamente
    //             //melhorando a experiência do usuário
    //             $("#numero").focus();
    //         }
    //     })
    // })