<?php



$hash = password_hash('123', PASSWORD_ARGON2I);

echo "$hash";

?>