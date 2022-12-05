<?php

namespace Source\Models;

use Source\Core\Model;

class RotaEnderecos extends Model
{

    //    public int $id;
    //    public int $id_indentificacao_externo;
    //    public string $descricao;
    //    public string $rua;
    //    public string $numero;
    //    public string $bairro;
    //    public string $cidade;
    //    public string $uf;
    //    public string $cep;
    //    public float $latitude;
    //    public float $longitude;
    //    public string $place_id;
    //    public string $endereco_completo;

    public function __construct()
    {
        parent::__construct("tb_enderecos", ["id"], [], [], [], "*");
    }


    public function findCodigoRota(?string $codigo, $array = true)
    {
        $data = $this->find("codigo_rota=:crota", "crota={$codigo}", "id, nome_rota, codigo_rota, descricao, id_indentificacao_externo,latitude,longitude, endereco_completo")->fetch(true);
        if ($array) {
            return $this->toArray($data);
        } else {
            return $data;
        }
    }

    public function toArray($data): array
    {
        $returnData = [];
        if ($data) {
            foreach ($data as $index) {
                $returnData[] = $index->data();
            }
        }
        return $returnData;
    }


}