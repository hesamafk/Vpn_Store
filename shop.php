<?php
declare(strict_types=1);
// Keep the original storefront URL while using the maintained catalogue.
header('Location: catalog.php', true, 302);
exit;
