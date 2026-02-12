<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $validacao = Validacao::validar([
        'email' => ['required', 'email'],
        'senha' => ['required']
    ], $_POST);

    if ($validacao->naoPassou('login')) {
        header("Location: /login");
        exit();
    }

    $usuario = $database->query(
        "SELECT * FROM usuarios WHERE email = :email",
        class: Usuario::class,
        params: compact('email')
    )->fetch();

    if ($usuario) {

        // Validar senha
        if(!password_verify($_POST['senha'], $usuario->senha)){

            flash()->push('validacoes', ['Usuário ou Senha estão incorretos!']);
            header('location: /login');
            exit();
        }

        $_SESSION['auth'] = $usuario;
        flash()->push('mensagem', 'Seja bem vindo, '. $usuario->nome . '!');

        header('location', '/');
        exit();
    }
}

view('login');
