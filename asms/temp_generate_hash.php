<?php $hash = password_hash("password123", PASSWORD_DEFAULT); file_put_contents(__DIR__."/hash.txt", $hash); echo $hash; ?>
