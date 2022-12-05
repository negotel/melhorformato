<?php

namespace Source\Support;

class UploadException
{

    public function codeToMessage($code)
    {
        switch ($code) {
            case UPLOAD_ERR_INI_SIZE:
                $message = "O arquivo carregado excede a diretiva upload_max_filesize";
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $message = "O arquivo enviado excede a diretiva MAX_FILE_SIZE especificada no formulário HTML";
                break;
            case UPLOAD_ERR_PARTIAL:
                $message = "O arquivo enviado foi carregado apenas parcialmente";
                break;
            case UPLOAD_ERR_NO_FILE:
                $message = "Nenhum arquivo foi carregado";
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                $message = "Faltando uma pasta temporária";
                break;
            case UPLOAD_ERR_CANT_WRITE:
                $message = "Falha ao gravar arquivo no disco";
                break;
            case UPLOAD_ERR_EXTENSION:
                $message = "Upload de arquivo interrompido por extensão";
                break;

            default:
                $message = "Unknown upload error";
                break;
        }
        return $message;
    }
}