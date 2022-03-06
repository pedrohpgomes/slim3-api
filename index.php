<?php

// aula 06 - arquitetura de software
// Lembrar de adicionar o psr-4 no composer.json para evitar require_once em todos os arquivos
// e, após, no terminal:
// composer dumpautoload -o

require_once '.env.php';
require_once 'src/slimConfiguration.php';
require_once 'src/basicAuth.php';
require_once 'routes/index.php';
require_once 'vendor/autoload.php';
