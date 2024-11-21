<?php
//codigo para receber as informaçoes do HTML e fazer algo
//captura o que o usuáo digitou e cadastra no bd

//chama arquivo de conexão
include 'conexao.php';

//verifica se existe alguma informação chegando pela rede
if($_SERVER["REQUEST_METHOD"] == "POST"){
    //RECEBE O EMAIL, FILTRA E ARMAZENA NA VARIAVEL
    $email = htmlspecialchars($_POST['email']);

    //recebe a senha, criptografa e armazena em uma variavel

$senha = password_hash($_POST['senha'],PASSWORD_DEFAULT);

//EXIBE A VARIAVEL PRA TESTAR
//var_dump($senha);
//bloco tente para cadastrar no banco de dados
try{
    //prepara o comando sql para inserir no banco de dados
    // utilizar o prepared para preverir injetar sql
    $stmt = $conn->prepare("INSERT INTO Usuarios (email,senha)
                            VALUES (:email, :senha)");
    
    //associa os valores das variaveis :email e :senha
    $stmt->bindParam(":email",$email); //vincula o email e limpa
    $stmt->bindParam(":senha",$senha);

    //executa o código
    $stmt->execute();

    echo "Cadastrado com Sucesso";
}catch(PDOException $e){
    echo "Erro ao cadastrar o usuário :".$e->getMessage();
}
}
