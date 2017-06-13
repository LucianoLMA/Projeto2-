<?php

class SegurancaModel extends Conexao {

    function __construct() {
        parent::__construct();
    }

    public function inserir(array $dados) {
        $cpf = $_POST['cpf'];
        $email = $_POST['email'];
        $idcidade = $_POST['idcidade'];
        
        $consultacpf = "select count(*) as quantidadecpf from usuario where cpf = '$cpf'";
        $sqlconsultacpf = $this->bd->prepare($consultacpf);
        $sqlconsultacpf->execute();
        
        if ($sqlconsultacpf->rowCount() > 0) {
            foreach ($sqlconsultacpf as $rs) {
                $quantidadecpf = $rs["quantidadecpf"];
            }
        }
		
        $consultaemail = "select count(*) as quantidadeemail from usuario where email = '$email'";
        $sqlconsultaemail = $this->bd->prepare($consultaemail);
        $sqlconsultaemail->execute();
        
        if ($sqlconsultaemail->rowCount() > 0) {
            foreach ($sqlconsultaemail as $rs) {
                $quantidadeemail = $rs["quantidadeemail"];
            }
        }
        
        if($quantidadecpf >= 1){
            echo "<script>alert('Este CPF já encontra-se cadastrado na base de dados! Favor informe outro CPF');</script>";
        }else if($quantidadeemail >= 1){
            echo "<script>alert('Este E-mail já encontra-se cadastrado na base de dados! Favor informe outro E-mail');</script>";
        }else{
            $sql = "INSERT INTO usuario(nome, sobrenome, datanascimento, cpf, telefone, celular, cnh, senha, endereco, email, idcidade, tipousuario) "
                    . "          VALUES(:nome, :sobrenome, :datanascimento, '$cpf', :telefone, :celular, :cnh, :senha, :endereco, '$email', $idcidade, 'S')";
            
            unset($dados['id']);
            unset($dados['cpf']);
            unset($dados['email']);
            unset($dados['idcidade']);
            unset($dados['confirmasenha']);
            unset($dados['tipousuario']);
            $query = $this->bd->prepare($sql);
            $query->execute($dados);
            
            $usuarioregistro = "select max(id) as idusuario from usuario";
            $sqlusuarioregistro = $this->bd->prepare($usuarioregistro);
            $sqlusuarioregistro->execute();

            if ($sqlusuarioregistro->rowCount() > 0) {
                foreach ($sqlusuarioregistro as $rs) {
                    $idusuarioregistro = $rs["idusuario"];
                }
            }
            
            if($idusuarioregistro != null){
                $sqlseguranca = "INSERT INTO seguranca(idusuario) VALUES($idusuarioregistro)";
                unset($dados['nome']);
                unset($dados['datanascimento']);
                unset($dados['sobrenome']);
                unset($dados['telefone']);
                unset($dados['celular']);
                unset($dados['cnh']);
                unset($dados['endereco']);
                unset($dados['senha']);
                unset($dados['idestado']);
                unset($dados['idcidade']);
                
                $query = $this->bd->prepare($sqlseguranca);
                return $query->execute($dados);
            }
        }
   }

    public function buscarTodos() {
    	$sql = "select cu.id,
                        (cu.nome || ' ' || cu.sobrenome) as nomeseguranca, 
                        to_char(cu.datanascimento, 'dd/MM/yyyy') as datanascimento,
                        cu.cpf,
                        cu.telefone,
                        cu.celular,
                        cu.cnh,
                        cu.endereco,
                        cu.email,
                        ci.nome || ' - ' || est.uf as cidadeestado,
                        c.id as idseguranca
                   from seguranca c 
                inner join usuario cu 
                          on c.idusuario = cu.id 
                inner join cidade ci 
                          on cu.idcidade = ci.id
                inner join estado est 
                          on ci.idestado = est.id
                order by cu.nome asc;";
        $query = $this->bd->query($sql);
        return $query->fetchAll();
    }

    public function buscar($id) {
        $sql = "select u.id,
                       u.nome,
                       u.sobrenome,
                       to_char(u.datanascimento, 'dd/MM/yyyy') as datanascimento,
                       u.cpf,
                       u.telefone,
                       u.celular,
                       u.cnh,
                       u.senha,
                       u.endereco,
                       u.idcidade,
                       u.email,
                       u.idcidade
                   from usuario u
                  inner join seguranca c
                     on c.idusuario = u.id
                 WHERE c.id = :id";
        $query = $this->bd->prepare($sql);
        $query->execute(array('id' => $id));
        return $query->fetch();
    }

    public function atualizar(array $dados) {
        $id             = $_POST['id'];
        $datanascimento = $_POST['datanascimento'];
        $cpf            = $_POST['cpf'];
        $email          = $_POST['email'];
        $idcidade       = $_POST['idcidade'];
        
        
        $sql = "UPDATE usuario 
                   SET nome           = :nome,
                       sobrenome      = :sobrenome,
                       datanascimento = '$datanascimento',
                       cpf            = '$cpf',
                       telefone       = :telefone,
                       celular        = :celular,
                       cnh            = :cnh,
                       senha          = :senha,
                       endereco       = :endereco,
                       email          = '$email',
                       idcidade       = $idcidade
                 WHERE id = $id";
        unset($dados['id']);
        unset($dados['datanascimento']);
        unset($dados['cpf']);
        unset($dados['email']);
        unset($dados['idcidade']);
        unset($dados['confirmasenha']);
        $query = $this->bd->prepare($sql);
        $query->execute($dados);
        
        
        $verificaregistrousuario = "select u.id as idusuario, c.id as idseguranca 
                                      from usuario u 
                                inner join seguranca c 
                                        on c.idusuario = u.id 
                                     where c.idusuario = $id";
        $sqlverificaregistrousuario = $this->bd->prepare($verificaregistrousuario);
        $sqlverificaregistrousuario->execute();
        if ($sqlverificaregistrousuario->rowCount() > 0) {
            foreach ($sqlverificaregistrousuario as $rs) {   
                $verificaidregistrousuario = $rs["idusuario"];
                $idseguranca = $rs["idseguranca"];
            }
        }
        
        //Atualiza segurança
        if($verificaidregistrousuario != null){
            $sqlSeguranca = "UPDATE seguranca
                                    SET idusuario = $verificaidregistrousuario
                                  WHERE id = $idseguranca";
            unset($dados['nome']);
            unset($dados['sobrenome']);
            unset($dados['telefone']);
            unset($dados['celular']);
            unset($dados['cnh']);
            unset($dados['endereco']);
            unset($dados['cidade']);
            unset($dados['confirmasenha']);
            $query = $this->bd->prepare($sqlSeguranca);
            return $query->execute($dados);
        }
        
    }

    public function excluir($id) {
        $idseguranca = $_GET['id'];
        $verificaregistro = "select us.id as idusuario,
                                    se.id as idseguranca
                               from seguranca se
                              inner join usuario us
                                 on se.idusuario = us.id
                              where se.id = $id;";
        $sqlverificaregistro = $this->bd->prepare($verificaregistro);
        $sqlverificaregistro->execute();
        if ($sqlverificaregistro->rowCount() > 0) {
            foreach ($sqlverificaregistro as $rs) {   
                $idusuario = $rs["idusuario"];
                $idseguranca = $rs["idseguranca"];
                
            }
        }
        
        $seguranca    = "delete from seguranca where id = $idseguranca";
        $sqlseguranca = $this->bd->prepare($seguranca);
        $this->bd->prepare($seguranca);
        $sqlseguranca->execute();
        
        
        $usuario = "delete from usuario where id = $idusuario";
        $sqlusuario = $this->bd->prepare($usuario);
        return $sqlusuario->execute();
    }
}