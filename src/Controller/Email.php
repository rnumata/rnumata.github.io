<?php

declare(strict_types=1);

namespace email_php\src\Controller;

use PHPMailer\PHPMailer\PHPMailer;

final class Email
{
    const NOME_DO_PROJETO = 'MB Advocacia';
    private static PHPMailer $mail;

    private static function configurarEmail(string $assunto, string $html): object
    {
        $mail = self::$mail ?? new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->addCustomHeader('MIME-Version: 1.0');
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';
        $mail->SMTPOptions = ['ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        ]];
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->Port = 2525;
        $mail->Username = '406c4ce299a6e1';
        $mail->Password = 'cfccdaff765514';
        $mail->FromName = self::NOME_DO_PROJETO;
        $mail->Subject = $assunto;
        $mail->WordWrap = 50;
        $mail->MsgHTML($html);
        $mail->IsHTML(true);
        return $mail;
    }

    private static function montarDadosParaEmail(
        array $dados = [],
        string $assunto = 'Contato Site'
    ): object {
        $html = '<html>
                    <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                        <title>' . self::NOME_DO_PROJETO . '</title>
                    </head>
                    <body style="margin:0px">
                        <table cellpadding="0" cellspacing="0" width="600px">
                            <tr>
                                <td>&nbsp;</td>';

        foreach ($dados as $key => $value) {
            $html .= $key . ':' . mb_convert_encoding($value, 'UTF-8') . '<br><br>';
        }
        $html .= '
                            </tr>
                        </table>
                    </body>
                </html>';

        return self::configurarEmail($assunto, $html);
    }

    public static function dispararEmail(
        string $assunto,
        array $dados,
        string $email,
        string $anexo = '',
        string $nomeAnexo = ''
    ): bool {
        $mail = self::montarDadosParaEmail($dados, $assunto);
        $mail->AddAddress($email, $email);
        if (!empty($anexo) && !empty($nomeAnexo)) {
            $mail->AddAttachment($anexo, $nomeAnexo);
        }
        $envio = $mail->Send();
        $mail->ClearAddresses();
        return $envio;
    }
}
