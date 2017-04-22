<?php

class ColaboradorModel extends Conexao {

    function __construct() {
        parent::__construct();
    }

    public function inserir(array $dados) {
        //Primeiro faz insert na tabela usuario
        $datanascimento = $_POST['datanascimento'];
        $cpf = $_POST['cpf'];
        $email = $_POST['email'];
        $idsetor = $_POST['idsetor'];
        $idgerente = $_POST['idgerente'];
        $idcidade = $_POST['idcidade'];
        
        //Verifica se CPF já esta cadastrado
        $consultacpf = "select count(*) as quantidadecpf from usuario where cpf = '$cpf'";
        $sqlconsultacpf = $this->bd->prepare($consultacpf);
        $sqlconsultacpf->execute();
        
        if ($sqlconsultacpf->rowCount() > 0) {
            foreach ($sqlconsultacpf as $rs) {
                $quantidadecpf = $rs["quantidadecpf"];
            }
        }
        
        //Verifica se e-mail já esta cadastrado
        $consultaemail = "select count(*) as quantidadeemail from usuario where email = '$email'";
        $sqlconsultaemail = $this->bd->prepare($consultaemail);
        $sqlconsultaemail->execute();
        
        if ($sqlconsultaemail->rowCount() > 0) {
            foreach ($sqlconsultaemail as $rs) {
                $quantidadeemail = $rs["quantidadeemail"];
            }
        }
        
        if($quantidadecpf >= 1){
            echo "<script>alert('CPF já cadastrado! Favor informe outro CPF');</script>";
        }else if($quantidadeemail >= 1){
            echo "<script>alert('E-mail já cadastrado! Favor informe outro E-mail');</script>";
        }else{ 
            $sql = "INSERT INTO usuario(nome, sobrenome, datanascimento, cpf, telefone, celular, cnh, senha, endereco, email, idcidade) "
                    . "          VALUES(:nome, :sobrenome, '$datanascimento', '$cpf', :telefone, :celular, :cnh, :senha, :endereco, '$email', $idcidade)";
            unset($dados['id']);
            unset($dados['cpf']);
            unset($dados['email']);
            unset($dados['idsetor']);
            unset($dados['idgerente']);
            unset($dados['idcidade']);
            unset($dados['datanascimento']);
            $query = $this->bd->prepare($sql);
            $query->execute($dados);
            
            //Após realizar o insert na tabela usuário,faz insert na tabela gerente, pegando o ultimo id 
            $usuarioregistro = "select max(id) as idusuario from usuario";
            $sqlusuarioregistro = $this->bd->prepare($usuarioregistro);
            $sqlusuarioregistro->execute();

            if ($sqlusuarioregistro->rowCount() > 0) {
                foreach ($sqlusuarioregistro as $rs) {
                    $idusuarioregistro = $rs["idusuario"];
                }
            }
            
            if($idusuarioregistro != null){
                $sqlgerente = "INSERT INTO colaborador(idsetor, idgerente, idusuario) "
                        . " VALUES($idsetor, $idgerente, $idusuarioregistro)";
                
                unset($dados['nome']);
                unset($dados['sobrenome']);
                unset($dados['telefone']);
                unset($dados['celular']);
                unset($dados['cnh']);
                unset($dados['endereco']);
                unset($dados['idestado']);
                unset($dados['idcidade']);
                unset($dados['senha']);
                $query = $this->bd->prepare($sqlgerente);
                return $query->execute($dados);
            }
        }
    }

    public function buscarTodos() {
    	$sql = "select u.id,
                        (u.nome || ' ' || u.sobrenome) as nomecolaborador,
                        (select (u.nome || ' ' || u.sobrenome) as nomegerente
                           from gerente ge
                          inner join usuario u
                             on ge.idusuario = u.id
                          inner join colaborador c
                             on c.idgerente = ge.id) as nomegerente,
                        to_char(u.datanascimento, 'dd/MM/yyyy') as datanascimento,
                        u.cpf,
                        u.telefone,
                        u.celular,
                        u.cnh,
                        u.endereco,
                        u.email,
                        ci.nome || ' - ' || est.uf as cidadeestado,
                        s.nome as nomesetor,
                        c.id as idcolaborador
                   from usuario u
                  inner join colaborador c
                     on c.idusuario = u.id
                  inner join setor s
                     on c.idsetor = s.id
                  inner join gerente g
                     on c.idgerente = g.id
                  inner join cidade ci
                     on u.idcidade = ci.id
                  inner join estado est
                     on ci.idestado = est.id
                  order by u.nome asc;";
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
                       u.idcidade,
                       c.idsetor,
                       (select usu.id
                          from gerente ge
                    inner join usuario usu
                            on ge.idusuario = usu.id) as idgerente,
                       c.idusuario
                   from usuario u
                  inner join colaborador c
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
        $idsetor        = $_POST['idsetor'];
        $idgerente      = $_POST['idgerente'];
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
        unset($dados['idsetor']);
        unset($dados['datanascimento']);
        unset($dados['cpf']);
        unset($dados['email']);
        unset($dados['idgerente']);
        unset($dados['idcidade']);
        $query = $this->bd->prepare($sql);
        $query->execute($dados);
        
        //Verifica o registro usuario para alterar
        $verificaregistrousuario = "select u.id as idusuario, c.id as idcolaborador 
                                      from usuario u 
                                inner join colaborador c 
                                        on c.idusuario = u.id 
                                     where c.idusuario = $id";
        $sqlverificaregistrousuario = $this->bd->prepare($verificaregistrousuario);
        $sqlverificaregistrousuario->execute();
        if ($sqlverificaregistrousuario->rowCount() > 0) {
            foreach ($sqlverificaregistrousuario as $rs) {   
                $verificaidregistrousuario = $rs["idusuario"];
                $idcolaborador = $rs["idcolaborador"];
                
            }
        }
        
        //Atualiza colaborador
        if($verificaidregistrousuario != null){
            $sqlColaborador = "UPDATE colaborador
                           SET idsetor   = $idsetor,
                               idgerente = $idgerente,
                               idusuario = $verificaidregistrousuario
                         WHERE id = $idcolaborador";
            unset($dados['nome']);
            unset($dados['sobrenome']);
            unset($dados['telefone']);
            unset($dados['celular']);
            unset($dados['cnh']);
            unset($dados['endereco']);
            unset($dados['cidade']);
            unset($dados['senha']);
            $query = $this->bd->prepare($sqlColaborador);
            return $query->execute($dados);
        }
        
    }

    public function excluir($id) {
        $idcolaborador = $_GET['id'];
        $verificaregistro = "select us.id as idusuario,
                                    co.id as idcolaborador
                               from colaborador co
                              inner join usuario us
                                 on co.idusuario = us.id
                              where co.id = $id;";
        $sqlverificaregistro = $this->bd->prepare($verificaregistro);
        $sqlverificaregistro->execute();
        if ($sqlverificaregistro->rowCount() > 0) {
            foreach ($sqlverificaregistro as $rs) {   
                $idusuario = $rs["idusuario"];
                $idcolaborador = $rs["idcolaborador"];
                
            }
        }
        
        $colaborador    = "delete from colaborador where id = $idcolaborador";
        $sqlcolaborador = $this->bd->prepare($colaborador);
        $this->bd->prepare($colaborador);
        $sqlcolaborador->execute();
        
        
        $usuario = "delete from usuario where id = $idusuario";
        $sqlusuario = $this->bd->prepare($usuario);
        return $sqlusuario->execute();
    }
}