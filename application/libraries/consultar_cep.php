<?php

class Consultar_cep
{
     private $endereco_ws = 'http://viacep.com.br/ws';
     private $url_ws;

     public function consulta_cep($cep)
     {
        $reg = simplexml_load_file("http://cep.republicavirtual.com.br/web_cep.php?formato=xml&cep=" . $cep);
        // $this->url_ws = $this->endereco_ws . '/' . $cep . '/json';

        $dados['sucesso'] = (string) $reg->resultado;
        $dados['rua']     = (string) $reg->tipo_logradouro . ' ' . $reg->logradouro;
        $dados['bairro']  = (string) $reg->bairro;
        $dados['cidade']  = (string) $reg->cidade;
        $dados['estado']  = (string) $reg->uf;
        
        // echo json_encode($dados);

        $resultado = json_encode($dados);


    //      //abre a conexão
    //      $ch = curl_init();

    //      //define url
    //      curl_setopt($ch, CURLOPT_URL, $this->url_ws);
    //      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    //      //executa o post
    //      $resultado = curl_exec($ch);

    //      if(curl_error($ch))
    //      {
    //          echo 'Erro: ' . curl_error($ch);
    //          return false;
    //      }
         return $resultado;

    //      //fecha a conexão
    //      curl_close($ch);
     }
}