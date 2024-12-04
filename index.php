<?php

use NeonWebId\Classes\Forms\Fields\TextInput;
use NeonWebId\Classes\Layouts\Section;

require_once __DIR__ . '/autoload.php'; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<div class="container">
    <?php
    echo Section::make('Form')
        ->description('Form example')
        ->icon('bi bi-file-earmark-text')
        ->columns([
                'default' => 12,
                'sm' => 6,
                'md' => 4
        ])
        ->schema([
            TextInput::make('name')
                ->label('Name')
                ->value('John Doe'),
            TextInput::make('email')
                ->label('Email')
                ->value('fasdfasd@mail.com')
        ])
        ->collapse()
        ->render();

    ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>