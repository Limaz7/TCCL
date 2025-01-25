    <?php

    session_start();
    session_regenerate_id(true);

    include "../conexao.php";
    $conecta = conectar();

    $nomeEven = $_POST["nomeEven"];
    $nomeEmp = $_POST['nomeEmp'];
    $desc = $_POST["desc"];
    $data = $_POST["data"];
    $foto = $_FILES['arquivo'];
    $rua = $_POST["rua"];
    $numImo = $_POST["numImo"];
    $bairro = $_POST["bairro"];
    $tipoPag = $_POST['tipoPagamento'];

    $extensao = strtolower(pathinfo($foto['name'], PATHINFO_EXTENSION));

    if ($foto['size'] > 10000000) {
        $_SESSION['mensagem'][0] = 'Essa imagem tem o tamanho maior que 10mb, escolha outra imagem';
        $_SESSION['mensagem'][1] = '#c62828 red darken-3';

        header("location: ../index");
        die();
    }

    if ($foto['error'] != UPLOAD_ERR_OK) {

        $_SESSION['mensagem'][0] = 'Ocorreu um erro no cadastro da imagem!' . $foto['error'];
        $_SESSION['mensagem'][1] = '#c62828 red darken-3';

        header("location: ../index.php");
        die();
    }

    if (
        $extensao != "jpg" && $extensao != "png"
        && $extensao != "gif" && $extensao != "jfif"
        && $extensao != "svg" && $extensao != "jpeg"
    ) {
        $_SESSION['mensagem'][0] = 'A imagem precisa ter uma das seguintes extensões: jpg, jpeg, png, gif, jfif, svg!';
        $_SESSION['mensagem'][1] = '#c62828 red darken-3';
        header('location: ../index.php');
        die();
    }

    if ($foto['error'] == UPLOAD_ERR_OK) {
        $pastaDestino = "../imagens/";
        $novo_nome_ft = uniqid() . "." . $extensao;
        $move_foto = move_uploaded_file($foto['tmp_name'], $pastaDestino . $novo_nome_ft);

        if (!$move_foto) {
            $_SESSION['mensagem'][0] = 'Erro ao mover a imagem para o diretório!';
            $_SESSION['mensagem'][1] = '#c62828 red darken-3';
            header("location: ../index.php");
            die();
        }
    }

    if ($conecta->errno) {
        die("erro" . $conecta->error);
    } else {
        $_SESSION['mensagem'][0] = 'Ocorreu um erro no cadastro do evento!';
        $_SESSION['mensagem'][1] = '#c62828 red darken-3';

        header("location: ../index.php");
    }

    $sql_even = "INSERT INTO eventos (id_usuario, nome_evento, tipo_pagamento, produtora, descricao, data, rua, bairro, numero_residencial, imagem) 
                    VALUES ('" . $_SESSION['user'][0] . "', '$nomeEven', '$tipoPag', '$nomeEmp', '$desc', '$data', '$rua', '$bairro', '$numImo', '$novo_nome_ft')";
    executarSQL($conecta, $sql_even);

    $_SESSION['mensagem'][0] = 'Evento cadastrado com sucesso!';
    $_SESSION['mensagem'][1] = '#558b2f light-green darken-3';

    header('location: ../index.php');
