<?php

class CidadeModel extends Conexao {

    function __construct() {
        parent::__construct();
    }

    public function inserir(array $dados) {
        $nomecidade = $_POST['nome'];
        //Ve se a cidade ja existe
        $consultacidade = "select count(*) as quantidadecidade from cidade where nome = '$nomecidade'";
        $sqlconsultacidade = $this->bd->prepare($consultacidade);
        $sqlconsultacidade->execute();
        
        if ($sqlconsultacidade->rowCount() > 0) {
            foreach ($sqlconsultacidade as $rs){
                $quantidadecidade = $rs["quantidadecidade"];
            }
        }
        if($quantidadecidade == 1){
            echo "<script>alert('Esta Cidade já cadastrada na base de dados! Favor informe outra Cidade');</script>";
        }else{
            $sql = "INSERT INTO cidade(nome, idestado)  VALUES(:nome, :idestado)";
            unset($dados['id']);
            $query = $this->bd->prepare($sql);
            return $query->execute($dados);
        }
    }

    public function buscarTodos() {
    	$sql = "select c.id,
                       c.nome,
                       e.nomeestado,
                       e.uf
                  from cidade c
                 inner join estado e
                    on c.idestado = e.id
                 order by c.nome asc;";
        $query = $this->bd->query($sql);
        return $query->fetchAll();
    }

    public function buscar($id) {
        $sql = "select c.id,
                       c.nome,
                       e.nomeestado,
                       e.id as idestado
                  from cidade c
                 inner join estado e
                    on c.idestado = e.id
                 WHERE c.id = :id";
        $query = $this->bd->prepare($sql);
        $query->execute(array('id' => $id));
        return $query->fetch();
    }

    public function atualizar(array $dados) {
        $nomecidade = $_POST['nome'];

        $consultacidade = "select count(*) as quantidadecidade from cidade where nome = '$nomecidade'";
        $sqlconsultacidade = $this->bd->prepare($consultacidade);
        $sqlconsultacidade->execute();
        
        if ($sqlconsultacidade->rowCount() > 0) {
            foreach ($sqlconsultacidade as $rs){
                $quantidadecidade = $rs["quantidadecidade"];
            }
        }
        if($quantidadecidade == 1){
            echo "<script>alert('Esta Cidade já cadastrada na base de dados! Favor informe outra Cidade');</script>";
        }else{
            $sql = "UPDATE cidade 
                       SET nome           = :nome,
                           idestado       = :idestado
                     WHERE id = :id";

            $query = $this->bd->prepare($sql);
            return $query->execute($dados);
        }
    }

    public function excluir($id) {
        $id = $_GET['id'];
        
        $cidade = "delete from cidade where id = $id";
        $sqlcidade = $this->bd->prepare($cidade);
        return $sqlcidade->execute();
    }
}