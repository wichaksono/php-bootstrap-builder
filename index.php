<?php

use NeonWebId\Layouts\Grid;
use NeonWebId\Layouts\Section;

require_once __DIR__ . '/src/autoload.php'; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/split-col.css">
</head>
<body>

<div class="container">
    <?php

    echo Grid::make()
        ->columns([
            'md' => 2,
            'sm' => 2,
        ])
        ->paddingBottom(2)
        ->paddingEnd(2)
        ->marginBottom(3)
        ->marginStart(3)
        ->schema([
            Section::make()
                ->title('center')
                ->icon('bi bi-person')
                ->description(
                    'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
                ),

            Section::make()
                ->title('center')
                ->icon('bi bi-person')
                ->description(
                    'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
                ),
        ])
        ->render();


    ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>