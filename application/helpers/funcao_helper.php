<?php

defined('BASEPATH') or exit('Ação não permitida');

function formata_data_banco_com_hora($string) 
{
        $dia_sem = date('w', strtotime($string));

        switch ($dia_sem) 
        {
            case 0:  $semana = "Domingo"; break;
            case 1:  $semana = "Segunda-feira"; break;
            case 2:  $semana = "Terça-feira"; break;
            case 3:  $semana = "Quarta-feira"; break;
            case 4:  $semana = "Quinta-feira"; break;
            case 5:  $semana = "Sexta-feira"; break;
            case 6:  $semana = "Sábado"; break;

            default:
                break;
        }

        $dia = date('d', strtotime($string));
        $mes_num = date('m', strtotime($string));
        $ano = date('Y', strtotime($string));
        $hora = date('H:i', strtotime($string));

        return $dia . '/' . $mes_num . '/' . $ano . ' ' . $hora;
}

function formata_data_banco_sem_hora($string) 
{
       $dia_sem = date('w', strtotime($string));

         switch ($dia_sem) 
        {
            case 0:  $semana = "Domingo"; break;
            case 1:  $semana = "Segunda-feira"; break;
            case 2:  $semana = "Terça-feira"; break;
            case 3:  $semana = "Quarta-feira"; break;
            case 4:  $semana = "Quinta-feira"; break;
            case 5:  $semana = "Sexta-feira"; break;
            case 6:  $semana = "Sábado"; break;

            default:
                break;
        }

    $dia = date('d', strtotime($string));
    $mes_num = date('m', strtotime($string));
    $ano = date('Y', strtotime($string));
    $hora = date('H:i', strtotime($string));

    return $dia . '/' . $mes_num . '/' . $ano;
}


