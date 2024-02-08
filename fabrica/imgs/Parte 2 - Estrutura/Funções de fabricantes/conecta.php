<?php
    // Incluir neste ponto o arquivo conecta.php
    require_once "../conecta.php";

    // _______________________________________________-

    // Programar a função lerFabricantes neste ponto
    function lerFabricantes(PDO $conexao):array {
        // String com o comando SQL
        $sql = "SELECT id, nome FROM fabricantes";
        try {
            // preparação do comando
            $consulta = $conexao->prepare($sql);

            // Execução do comando
            $consulta->execute();

            // capturar os resultados
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $erro) {
            die ("Erro" .$erro->getMessage());
        }
        return $resultado;
    }
    // _______________________________________

    // Inserir um fabricante (PDO - PHP Database Object)
    // Obs void indica que a função não tem retorno "return"

    // Programar a função inserirFabricante neste ponto
    function inserirFabricante(PDO $conexao, string $none):void {

        // Insere no Banco de dados o valor digitado pelo usuário no formulário armazenado na variável $none
        // Obs Não é necessário criar para o ID que é automático

        // :qualquer_coisa -> isso é um named parameter
        $sql = "INSERT INTO fabricantes(nome) VALUES(:nome)";
        try {
            $consulta = $conexao->prepare($sql);

            // bindParam('nome do parametro', $variavel_com_valor, constante de verificação)
            $consulta->bindParam(':nome', $nome, PDO::PARAM_STR);
            $consulta->execute();

        } catch (Exception $erro) {
            die("Erro: ".$erro->getMessage());
        }
    }
    // ________________________________________________

    // Programar a função LerUmFabricante neste ponto
    function lerUmFabricante(PDO $conexao, int $id):array {
        $sql = "SELECT id, nome FROM fabricantes WHERE id = :id";
        try {
            $consulta = $conexao->prepare($sql);
            $consulta->bindParam(':id', $id, PDO::PARAM_INT);
            // Aqui usado fetch porque é apenas 1 fabricante
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);

        } catch (Exception $erro){
            die("Erro: ".$erro->getMessage());
        }
        return $resultado;

    }
    // ____________________________________


    // Programar a função atualizarFabricante neste ponto
    function atualizarFabricante(PDO $conexao, int $id, string $nome):void {
        $sql = "UPDATE fabricantes set nome = :nome WHERE id = :id ";
        try {
            $consulta = $conexao->prepare($sql);
            $consulta->bindParam(':id', $id, PDO::PARAM_INT);
            $consulta->bindParam(':nome', $nome, PDO::PARAM_STR);
            $consulta->execute();

        }   catch (Exception $erro) {
            die("Erro: ".$erro->getMessage());
        }
    }
    // ________________________________________

    // Programar a função excluirFabricante neste ponto
    function excluirFabricante(PDO $conexao, int $id):void {
        $sql = "DELETE FROM fabricantes WHERE id = :id ";
        try {
            $consulta = $conexao->prepare($sql);
            $consulta->bindParam(':id', $id, PDO::PARAM_INT);
            $consulta->execute();

        } catch (Exception $erro) {
            die("Erro: ".$erro->getMessage());
        }
    }


?>
