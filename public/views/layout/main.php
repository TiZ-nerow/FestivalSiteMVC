<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= config('app.title') ?></title>
</head>
<body>
    <?= view('components/message') ?>

    <?= $content ?>
</body>
</html>
