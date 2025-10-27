<?php
// include_once ('includes/config.inc.php');
// $here = new Here();

// $rs = $here->BuscarEndereco('tv izaltino braz de bomfim 64 colombo pr');

// Conexao::pr($rs);
session_name('SIGA-SAMU');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Set some session variables
$_SESSION['user_id'] = 1;
$_SESSION['username'] = 'John Doe';
$_SESSION['is_logged_in'] = true;

// You can add more session variables as needed
$_SESSION['last_login'] = date('Y-m-d H:i:s');

echo '<div>';
print_r($_SESSION);
echo '</div>';

