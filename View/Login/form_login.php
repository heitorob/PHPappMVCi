<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Biblioteca - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div>
        <h1>Login</h1>

        <?= $erro ?>

        <form method="post" action="/login" class="p-5">
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" value="<?= $model->Email ?>" class="form-control" name="email" id="email">
            </div>
            <div class="mb-3">
                <label for="senha" class="form-label">Senha:</label>
                <input type="password" class="form-control" name="senha" id="senha">
            </div>
            <div class="mb-3">
                <input type="checkbox" name="lembrar" id="lembrar">
                <label for="lembrar" class="form-label">Lembrar meu usuário.</label>
            </div>
            <button type="submit" class="btn btn-primary">Entrar</button>
            <a class="btn btn-link" href="/usuario/cadastro" role="button">Não possui uma conta?</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>