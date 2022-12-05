<?php

namespace Source\Application\Web;

use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Source\Models\RotaEnderecos;
use Source\Support\UploadException;

/**
 *
 */
class Mapa extends Web
{

    private array $allowAcceptExtension = ["xlsx", "Xls", "Xml", "Csv", "Txt"];
    private array $allowAcceptHeader = ["ididentificacao", "descricao", "endereco", "numero", "bairro", "cidade", "uf", "cep"];

    public function index()
    {
        echo $this->view->render('mapa', []);
    }

    public function mapaNovo()
    {
        echo $this->view->render('mapa/mapa-novo', []);
    }

    public function importacao(?array $data)
    {

        $file = $_FILES['inputGroupFile04'];

        if ($file['error'] >= 1) {
            $mess = (new UploadException())->codeToMessage($file['error']);
            echo $this->message->error("{$mess}")->json();
            return false;
        }
        try {

            $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($file['tmp_name']);

            //VERIFICA SE O ARQUIVO E COMPATIVEL COM $allowAcceptExtension
            if (!in_array(strtolower($inputFileType), $this->allowAcceptExtension)) {
                echo $this->message->error("Ops! Este arquivo não compatível com nossas polictica de importação!")->json();
                return false;
            }

            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
            $spreadsheet = $reader->load($file['tmp_name']);
            $schdeules = $spreadsheet->getActiveSheet()->toArray();

            if (!$this->compararHearder($schdeules)) {
                echo $this->message->error("Ops! O cabeçalho do arquivo não compatível com nossas polictica de importação, por favor revise seu arquivo antes de importa-lo!")->json();
                return false;
            }

            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

            for ($i = 1; $i < count($schdeules); $i++) {

                $REInsert = new RotaEnderecos();
                $REInsert->nome_rota = $data['nomeRota'];
                $REInsert->codigo_rota = $data['codigo'];
                $REInsert->id_indentificacao_externo = $schdeules[$i][0];
                $REInsert->descricao = ($schdeules[$i][1]);
                $REInsert->rua = ($schdeules[$i][2]);

                $extrairNumeroEndereco = $schdeules[$i][3];
                if ($schdeules[$i][3] == null) {
                    $extrairNumeroEndereco = explode(",", $schdeules[$i][2]);
                    $extrairNumeroEndereco = $extrairNumeroEndereco[1];
                }

                $REInsert->numero = (trim($extrairNumeroEndereco));
                $REInsert->bairro = ($schdeules[$i][4]);
                $REInsert->cidade = ($schdeules[$i][5]);
                $REInsert->uf = ($schdeules[$i][6]);

                $cep = str_pad(limpa_caracteres($schdeules[$i][7]), 8, 0, STR_PAD_LEFT);
                $REInsert->cep = ($cep);

                $endereco = "{$schdeules[$i][2]}, {$schdeules[$i][3]} - {$schdeules[$i][4]}, {$schdeules[$i][5]}-{$schdeules[$i][6]}, {$cep}";
                $geolocalizao = geolocalizao_google_maps($endereco);
                if ($geolocalizao) {
                    $REInsert->latitude = ($geolocalizao["latitude"]);
                    $REInsert->longitude = ($geolocalizao["longitude"]);
                    $REInsert->place_id = ($geolocalizao["place_id"]);
                    $REInsert->endereco_completo = ($geolocalizao["address_formatted"]);
                }

                if (!$REInsert->save()) {
                    echo $this->message->error($REInsert->message()->json())->json();
                    return false;
                }
            }

            $dataInserido = (new RotaEnderecos())->findCodigoRota($data['codigo']);
            echo $this->message->success("Success!")->json(['data' => $dataInserido]);

        } catch (Exception $e) {
            echo $this->message->error("Ops! Este arquivo não compatível com nossas polictica de importação!")->json();
            return false;
        }
    }

    public function htmlTableModal(?array $itensTable)
    {

        $htmlTableTR = "<tr>";

        foreach ($itensTable as $item) {
            $htmlTableTR .= "<td>{$item->id}</td>";
            $htmlTableTR .= "<td>{$item->descricao}</td>";
            $htmlTableTR .= "<td>{$item->endereco_completo}</td>";
            $htmlTableTR .= "<td>{$item->latitude}</td>";
            $htmlTableTR .= "<td>{$item->longitude}</td>";
            $htmlTableTR .= "<td>";
            $htmlTableTR .= "<span class='text-nowrap'>";
            //buttom 01
            $htmlTableTR .= "<button type='button' class='btn btn-icon btn-info'>";
            $htmlTableTR .= "<span class='tf-icons bx bx-arrow-to-right'></span>";
            $htmlTableTR .= "</button>";
            //buttom 02
            $htmlTableTR .= "<button type='button' class='btn btn-icon btn-danger'>";
            $htmlTableTR .= "<span class='tf-icons bx bx-trash'></span>";
            $htmlTableTR .= "</button>";
            $htmlTableTR .= "</span>";
            $htmlTableTR .= "</td>";
        }

        $htmlTableTR .= "</tr>";

        return $htmlTableTR;
    }

    /**
     * COMPARA SE O CABEÇALHO DO ARQUIVO ESTA DE ACORDO COM $allowAcceptHeader
     * @param array $data
     * @return bool
     */
    private function compararHearder(array $data): bool
    {
        if (!is_array($data[0])) return false;

        $t = 0;
        for ($i = 0; $i < count($data[0]); $i++) (strtolower($data[0][$i]) === $this->allowAcceptHeader[$i]) ? $t += 1 : $t -= 1;
        return (($t === 8));

    }
}