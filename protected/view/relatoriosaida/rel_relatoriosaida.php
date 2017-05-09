<?php
require_once("../../../config/confloginrel.php");
require_once("../../fpdf/fpdf.php");

$in_idveiculo = $_POST['idveiculo'];
$in_cpf = $_POST['cpf'];
$in_datasaidainicio = $_POST['datasaidainicio'];
$in_datasaidafim = $_POST['datasaidafim'];

//Filtro apenas com o Veiculo
if($in_idveiculo != "" && $in_cpf == "" && $in_datasaidafim == "" && $in_datasaidafim == ""){
  $filtropesquisa = 'where v.id = ' . " $in_idveiculo";
}else if($in_idveiculo != "" && $in_cpf != "" && $in_datasaidainicio == "" && $in_datasaidafim == ""){
  // Filtro com Veiculo e CPF
  $filtropesquisa = 'where v.id = ' . " $in_idveiculo" . ' and u.cpf = ' . "'$in_cpf'";
}else if($in_idveiculo == "" && $in_cpf != "" && $in_datasaidainicio != "" && $in_datasaidafim == ""){
  // Filtro com Veículo, CPF, Data Saida Inicio
  $filtropesquisa = 'where v.id >= ' . "$in_idveiculo" . ' and u.cpf = ' . "'$in_cpf'" . ' and r.datasaida >= ' . "'$in_datasaidainicio'";
}else if($in_idveiculo != "" && $in_cpf != "" && $in_datasaidainicio == "" && $in_datasaidafim != ""){
  //Pesquisa com Veículo, CPF, e Data Saida Fim
    $filtropesquisa = 'where v.id >= ' . "$in_idveiculo" . ' and u.cpf = ' . "'$in_cpf'" . ' and r.datasaida <= ' . "'$in_datasaidafim'";
}else if($in_idveiculo == "" && $in_cpf != "" && $in_datasaidafim == "" && $in_datasaidafim == ""){
  //Pesquisa somente CPF
  $filtropesquisa = 'where u.cpf = ' . "'$in_cpf'";
}else if($in_idveiculo == null && $in_cpf != "" && $in_datasaidainicio != "" && $in_datasaidafim == ""){
    //Filtro por CPF, Data Saida Inicio
    $filtropesquisa = 'where u.cpf = ' . "'$in_cpf'" . ' and r.datasaida >= ' . "'$in_datasaidainicio'";
}else if($in_idveiculo == null && $in_cpf != "" && $in_datasaidainicio != "" && $in_datasaidafim == ""){
    //Filtro com CPF e Data Saida Fim
    $filtropesquisa = 'where u.cpf = ' . "'$in_cpf'" . ' and r.datasaida <= ' . "'$in_datasaidafim'";
}else if($in_idveiculo == null && $in_cpf != "" && $in_datasaidainicio != "" && $in_datasaidafim != ""){
    //Filtro com CPF, Data Saida Inicio e Fim   
    $filtropesquisa = 'where u.cpf = ' . "'$in_cpf'" . ' and r.datasaida >= ' . "'$in_datasaidainicio'" . ' and r.datasaida <= ' . "'$in_datasaidafim'";
}else if($in_idveiculo == null && $in_cpf == "" && $in_datasaidainicio != "" && $in_datasaidafim == ""){
    //Somente Data Inicio   
    $filtropesquisa = 'where r.datasaida >= ' . "'$in_datasaidainicio'";
}else if($in_idveiculo == null && $in_cpf == "" && $in_datasaidainicio == "" && $in_datasaidafim != ""){
    //Somente data Fim
    $filtropesquisa = 'where r.datasaida <= ' . "'$in_datasaidafim'";
}else if($in_idveiculo == null && $in_cpf == "" && $in_datasaidainicio != "" && $in_datasaidafim != ""){
    //Data Inicio e Data Fim
    $filtropesquisa = 'where r.datasaida >= ' . "'$in_datasaidainicio'" . ' and r.datasaida <= ' . "'$in_datasaidafim'";
}else if($in_idveiculo != null && $in_cpf != "" && $in_datasaidainicio == "" && $in_datasaidafim == ""){
    //Veículo e CPF
    $filtropesquisa = 'where v.id = ' . "$in_idveiculo" . ' and u.cpf = ' . "'$in_cpf'";
}else if($in_idveiculo != null && $in_cpf == "" && $in_datasaidainicio != "" && $in_datasaidafim == ""){
    //Filtro com Veículo e Data Saida Início
    $filtropesquisa = 'where v.id = ' . "$in_idveiculo" . ' and r.datasaida >= ' . "'$in_datasaidainicio'";
}else if($in_idveiculo != null && $in_cpf == "" && $in_datasaidainicio == "" && $in_datasaidafim != ""){
    //Filtro com Veículo e Data Saida Fim
    $filtropesquisa = 'where v.id = ' . "$in_idveiculo" . ' and r.datasaida <= ' . "'$in_datasaidafim'";
}else if($in_idveiculo != null && $in_cpf == "" && $in_datasaidainicio != "" && $in_datasaidafim != ""){
    //Filtro com Veículo e Data Saida Inicio e Fim
    $filtropesquisa = 'where v.id = ' . "$in_idveiculo" . ' and r.datasaida >= ' . "'$in_datasaidainicio'" . ' and r.datasaida <= ' . "'$in_datasaidafim'";
}
else if($in_idveiculo != null && $in_cpf != "" && $in_datasaidainicio != "" && $in_datasaidafim != ""){
    //Filtrar por todos os parâmetros
    $filtropesquisa = 'where v.id = ' . $in_idveiculo . ' and u.cpf = ' . "'$in_cpf'" . ' and r.datasaida >= ' . "'$in_datasaidainicio'" . " and r.datasaida <= " . "'$in_datasaidafim'";
}
else{
  //Pesquisa por nenhum filtro
  $filtropesquisa = null;
}

    $pdf = new FPDF("P", "pt", "A4");

    $pdf->AddPage('L');
    $pdf->SetFont('arial', 'B', 12);
    $pdf->Cell(0, 5, utf8_decode("Locadora Veículos - Relatório de Reserva de Saída"), 0, 1, 'C');
    $pdf->Ln(3);

    //Contorno Margens do relatório
    $pdf->Line(830, 10, 10, 10);
    $pdf->Line(10, 580, 10, 10);
    $pdf->Line(830, 580, 830, 10);
    $pdf->Line(830, 580, 10, 580);

    //CABEÇALHO DO RELATÓRIO
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(80);
    $pdf->Ln(20);
    
    //CABEÇALHO DA TABELA
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->setFillColor(180, 180, 180);
    $pdf->Cell(115, 14, utf8_decode('Nome'), 1, 0, 'L', 1);
    $pdf->Cell(70, 14, utf8_decode('CPF'), 1, 0, 'L', 1);
    $pdf->Cell(60, 14,  utf8_decode('Veículo'), 1, 0, 'L', 1);
    $pdf->Cell(80, 14, utf8_decode('Data/Hora Saída'), 1, 0, 'C', 1);
    $pdf->Cell(50, 14,  utf8_decode('Km. Inicial'), 1, 0, 'C', 1);
    $pdf->Cell(50, 14,  utf8_decode('Km. Final'), 1, 0, 'C', 1);
    $pdf->Cell(100, 14, utf8_decode('Destino'), 1, 0, 'L', 1);
    $pdf->Cell(120, 14, utf8_decode('Motivo'), 1, 0, 'L', 1);
    $pdf->Cell(150, 14, utf8_decode('Observação'), 1, 0, 'C', 1);
    $pdf->Ln();

    //DADOS DA TABELA
    $pdf->SetFont('Arial', '', 8);
    $query = "select upper(u.nome) || ' ' || upper(u.sobrenome) as nomeusuario,
                     u.cpf,
                     upper(v.modelo) as modeloveiculo,
                     to_char(r.datasaida, 'dd/MM/yyyy') || ' - ' ||  (r.horasaida) as datahorasaida,
                     r.kminicial as kminicial,
                     r.kmfinal as kmfinal,
                     r.destino as destino,
                     r.motivo as motivo,
                     r.observacao as observacao
                from reserva r
               inner join reservacolaborador rc
                  on rc.idreserva = r.id
               inner join veiculo v
                  on r.idveiculo = v.id
               inner join colaborador c
                  on rc.idcolaborador = c.id
               inner join usuario u
                  on c.idusuario = u.id
                     $filtropesquisa
               order by u.nome, r.datasaida asc";
    $result = pg_query($query);
    
    while ($consulta = pg_fetch_assoc($result)) {
        $pdf->SetFillColor(255, 255, 255);
        $pdf->Cell(115, 12, utf8_decode($consulta['nomeusuario']), 1, 0, 'L', 1);
        $pdf->Cell(70, 12, '021.346.190-07', 1, 0, 'L', 1);
        $pdf->Cell(60, 12, utf8_decode($consulta['modeloveiculo']), 1, 0, 'L', 1);
        $pdf->Cell(80, 12, utf8_decode($consulta['datahorasaida']), 1, 0, 'C', 1);
        $pdf->Cell(50, 12, $consulta['kminicial'], 1, 0, 'C', 1);
        $pdf->Cell(50, 12, $consulta['kmfinal'], 1, 0, 'C', 1);
        $pdf->Cell(100, 12, utf8_decode($consulta['destino']), 1, 0, 'L', 1);
        $pdf->Cell(120, 12, utf8_decode($consulta['motivo']), 1, 0, 'L', 1);
        $pdf->Cell(150, 12, utf8_decode($consulta['observacao']), 1, 0, 'L', 1);
        $pdf->Ln();
    }
    $pdf->Ln();
    
    
    // Rodapé
    $pdf->Line(552, 810, 452, 810);
    $pdf->SetXY(01, 530);
    $data = date("d/m/Y H:i:s");
    $conteudo = $data . utf8_decode(" Pág. ") . $pdf->PageNo();
    $pdf->Cell(790, 5, $conteudo, 10, 0, "R");
    
    $pdf->Output("rel_relatoriosaida.pdf", "D");
    
    pg_close($conexao);
