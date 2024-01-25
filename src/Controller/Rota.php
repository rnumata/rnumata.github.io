<?php

declare(strict_types=1);

namespace email_php\src\Controller;

require_once dirname(__DIR__, 2) . '/vendor/autoload.php';

const EMAIL_DESTINO = 'eliseuvidal64@gmail.com'; // AQUI VAI O ENDEREÇO DE EMAIL DA SUA ESPOSA PRA RECEBER OS CTT

if (!empty(filter_input(INPUT_GET, 'acao')) && filter_input(INPUT_GET, 'acao') === 'enviar') {
    $dados = [
        'nome' => filter_input(INPUT_POST, 'nome'),
        'email' => filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL),
        'telefone' => filter_input(INPUT_POST, 'telefone'),
        'mensagem' => filter_input(INPUT_POST, 'mensagem')
    ];
    validarDadosEntrada($dados);
    if (Email::dispararEmail('Contato', $dados, EMAIL_DESTINO)) {
        gerarMensagemAjax();
    }
    gerarMensagemAjax(true, 'Erro ao enviar email!');
}

gerarMensagemAjax(true, 'Erro ao enviar email!');

function gerarMensagemAjax(bool $erro = false, string $msg = 'Email enviado!'): void
{
    print_r(json_encode([
        'erro' => $erro,
        'message' => $msg,
    ]));
    exit;
}

function validarDadosEntrada(array $dados): void
{
    $valido = match (true) {
        empty($dados['nome']) => 'Você precisa preencher o campo MENSAGEM corretamente!',
        empty($dados['email']) => 'Você precisa preencher um E-MAIL válido!',
        empty($dados['telefone']) => 'Você precisa preencher um TELEFONE válido!',
        empty($dados['mensagem']) => 'Você precisa preencher o campo MENSAGEM corretamente!',
        default => false
    };
    if (!empty($valido)) {
        gerarMensagemAjax(true, $valido);
    }
    $regex = '/^\(?(?:(?:(?:00|\+)?55\D{0,2}\()?0?[1-9][0-9]\)?\D?)(?:(?:9[2-9]|[2-9][0-8])\D?[0-9]{3}\D?[0-9]{4}|(?:[2-9]|9[2-9])\D?[0-9]{3}\D?[0-9]{3})\)?$/';
    if (!preg_match($regex, $dados['telefone'])) {
        gerarMensagemAjax(true, 'Você precisa preencher um TELEFONE válido!');
    }
}
