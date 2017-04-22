<?php

class VeiculoModel extends Conexao {

    function __construct() {
        parent::__construct();
    }

    public function inserir(array $dados) {
        $nomefoto = null;
        $caminhofoto = null;
        
        $kminicial = $_POST['kminicial'];
        $kmfinal = $_POST['kmfinal'];
        $anomodelo = $_POST['anomodelo'];
        $anofabricacao = $_POST['anofabricacao'];
        
        $intervalo = ($anomodelo - $anofabricacao);
        
        if(($intervalo < -1) || ($intervalo > 1)){
            echo "<script>alert('O Intervalo entre o Ano de Fabricação e Ano do Modelo não pode ser maior que 1!');</script>"; 
        }else{
            if($kminicial > $kmfinal){
                echo "<script>alert('O Km Inicial não pode ser maior que o Km Final. Por favor informe a Km correta!');</script>"; 
             }else{
                 $sql = "INSERT INTO veiculo(modelo, placa, chassi, versao, anomodelo, anofabricacao, kminicial, kmfinal, nomefoto, caminhofoto) 
                                 VALUES(:modelo, :placa, :chassi, :versao, $anomodelo, $anofabricacao, $kminicial, $kmfinal, '$nomefoto', '$caminhofoto')";
                 unset($dados['id']);
                 unset($dados['kminicial']);
                 unset($dados['kmfinal']);
                 unset($dados['caminhofoto']);
                 unset($dados['nomefoto']);
                 unset($dados['anomodelo']);
                 unset($dados['anofabricacao']);
                 $query = $this->bd->prepare($sql);
                 return $query->execute($dados);
             }
        }
    }

    public function buscarTodos() {
    	$sql = "select id,
                       modelo,
                       placa, 
                       chassi,
                       versao,
                       anomodelo,
                       anofabricacao,
                       kminicial,
                       kmfinal,
                       nomefoto,
                       caminhofoto
                  from veiculo
                  order by modelo asc;";
        $query = $this->bd->query($sql);
        return $query->fetchAll();
    }

    public function buscar($id) {
        $sql = "SELECT id,
                       modelo,
                       placa, 
                       chassi,
                       versao,
                       anomodelo,
                       anofabricacao,
                       kminicial,
                       kmfinal,
                       nomefoto,
                       caminhofoto
                  FROM veiculo
                 WHERE id = :id";
        $query = $this->bd->prepare($sql);
        $query->execute(array('id' => $id));

        return $query->fetch();
    }

    public function atualizar(array $dados) {
        $anomodelo = $_POST['anomodelo'];
        $anofabricacao = $_POST['anofabricacao'];
        $nomefoto = isset($_POST['nomefoto']);
        $caminhofoto = isset($_POST['caminhofoto']);
        $kminicial = $_POST['kminicial'];
        $kmfinal = $_POST['kmfinal'];
        
        
        $intervalo = ($anomodelo - $anofabricacao);
       
        if(($intervalo < -1) || ($intervalo > 1)){
            echo "<script>alert('O Intervalo entre o Ano de Fabricação e Ano do Modelo não pode ser maior que 1!');</script>"; 
        }else{
            if($kminicial > $kmfinal){
                echo "<script>alert('O Km Inicial não pode ser maior que o Km Final. Por favor informe a Km correta!');</script>"; 
             }else{
                $sql = "UPDATE veiculo 
                           SET modelo = :modelo,
                               placa  = :placa,
                               chassi = :chassi,
                               versao  = :versao    ,
                               anomodelo  = $anomodelo,
                               anofabricacao  = $anofabricacao,
                               kminicial  = $kminicial,
                               kmfinal  = $kmfinal,
                               nomefoto  = '$nomefoto',
                               caminhofoto  = '$caminhofoto'
                         WHERE id = :id";
                
                unset($dados['nomefoto']);
                unset($dados['caminhofoto']);
                unset($dados['kminicial']);
                unset($dados['kmfinal']);
                unset($dados['anomodelo']);
                unset($dados['anofabricacao']);
                 
                $query = $this->bd->prepare($sql);
                return $query->execute($dados);
             }
        }
    }

    public function excluir($id) {
        $sql = "DELETE FROM veiculo WHERE id = :id";
        $query = $this->bd->prepare($sql);
        return $query->execute(array('id' => $id));
    }
}