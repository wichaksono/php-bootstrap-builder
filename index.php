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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

<div class="container">
    <div class="form-floating mb-3">
        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
        <label for="floatingInput">Email address</label>
    </div>
    <?php
    echo Section::make('Form')
        ->description('Form example')
        ->icon('bi bi-file-earmark-text')
        ->attributes([
                'data-bs-spy' => 'scroll',
        ])
        ->columns([
                'default' => 12,
                'sm' => 6,
                'md' => 4
        ])
        ->schema([
            TextInput::make('name')
                ->label('Name')
                ->placeholder('Your name')
                ->floating(),
            TextInput::make('email')
                ->label('Email')
                ->value('fasdfasd@mail.com'),
            TextInput::make('countries')
                ->label('Countries')
                ->placeholder('Select country')
                ->dataList([
                    'Indonesia',
                    'Malaysia',
                    'Singapore',
                    'Thailand',
                    'Vietnam',
                ]),
        ])
        ->render();

    ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>