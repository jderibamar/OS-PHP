$(document).ready(function ($) 
{
    var pessoa_fisica = $('#pessoa_fisica');
    var pessoa_juridica = $('#pessoa_juridica');

    if (pessoa_fisica.is(":checked")) 
    {
        $('.pessoa_juridica').hide();
        $('.pessoa_fisica').show();
    }

    if (pessoa_juridica.is(":checked")) 
    {
        $('.pessoa_fisica').hide();
        $('.pessoa_juridica').show();
    }

    pessoa_fisica.click(function () 
    {
        $('.pessoa_juridica').hide();
        $('.pessoa_fisica').show();
    });

    pessoa_juridica.click(function () 
    {
        $('.pessoa_fisica').hide();
        $('.pessoa_juridica').show();
    });
    
    $('#btn_buscar').click( () => 
    {
            var cep = $('#cep').val()
            if(cep == '')
            {
                    alert('Informe o CEP a ser pesquisado!')
                    $('#cep').focus()
                    return false
            }

            $('#btn_buscar').html('Aguarde...')

            $.post("index.php/clientes/consulta_cep", 
                { cep: cep }, 
                function(dados)
                {
                    console.log(dados)
                    $('#bairro').val(dados.bairro)
                    $('#endereco').val(dados.logradouro)
                    $('#cidade').val(dados.localidade)
                    $('#uf').val(dados.uf)
                    $('#btn_buscar').html('Consultar')
                }, 'json'
            )
    })
});