<?php

class AdministradorModel extends Conexao {

    function __construct() {
        parent::__construct();
    }

    public function inserir(array $dados) {
       $idusuario = $_POST['idusuario'];
        //Ve se já eh administrador
        $consultaadministrador = "select count(*) as quantidadeadministrador from administrador where idusuario = $idusuario";
        $sqlconsultaadministrador = $this->bd->prepare($consultaadministrador);
        $sqlconsultaadministrador->execute();
        
        if ($sqlconsultaadministrador->rowCount() > 0) {
            foreach ($sqlconsultaadministrador as $rs){
                $quantidadeadministrador = $rs["quantidadeadministrador"];
            }
        }
        if($quantidadeadministrador == 1){
            echo "<script>alert('Este Usuário já é Administrador! Favor informe outro Usuário');</script>";
        }else{
            $sql = "INSERT INTO administrador(idusuario, administrador)  VALUES($idusuario, 'S')";
            
            unset($dados['id']);
            unset($dados['idusuario']);
            unset($dados['administrador']);
            $query = $this->bd->prepare($sql);
            return $query->execute($dados);
        }
    }

    public function buscarTodos() {
    	$sql = "select a.id,
                       (u.nome || ' ' || u.sobrenome) as nomeusuario, 
                       u.cpf,
                       u.telefone
                  from administrador a
                 inner join usuario u
                    on a.idusuario = u.id
                 order by u.nome asc;";
        $query = $this->bd->query($sql);
        return $query->fetchAll();
    }

    public function buscar($id) {
        $sql = "select a.id,
                       a.idusuario,
                       a.administrador
                  from administrador a
                 WHERE a.id = :id";
        $query = $this->bd->prepare($sql);
        $query->execute(array('id' => $id));
        return $query->fetch();
    }

    public function atualizar(array $dados) {
        $idusuario = $_POST['idusuario'];
        
        $consultaadministrador = "select count(*) as quantidadeadministrador from administrador where idusuario = $idusuario";
        $sqlconsultaadministrador = $this->bd->prepare($consultaadministrador);
        $sqlconsultaadministrador->execute();
        
        if ($sqlconsultaadministrador->rowCount() > 0) {
            foreach ($sqlconsultaadministrador as $rs){
                $quantidadeadministrador = $rs["quantidadeadministrador"];
            }
        }
        if($quantidadeadministrador == 1){
            echo "<script>alert('Este usuário já é Administrador! Favor informe outro usuário');</script>";
        }else{
            $sql = "UPDATE administrador 
                       SET idusuario = $idusuario,
                           administrador  = 'S'
                     WHERE id = :id";
            unset($dados['administrador']);
            unset($dados['idusuario']);
            $query = $this->bd->prepare($sql);
            return $query->execute($dados);
        }
    }

    public function excluir($id) {
        $id = $_GET['id'];
        
        $administrador = "delete from administrador where id = $id";
        $sqladministrador = $this->bd->prepare($administrador);
        return $sqladministrador->execute();
    }
}