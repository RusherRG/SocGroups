<?php
// router.php
if (preg_match('/\.(?:png|jpg|jpeg|gif)$/', $_SERVER["REQUEST_URI"])) {
    return false;    // serve the requested resource as-is.
} else if (preg_match('/'), $_SERVER["REQUEST_URI"]) { 
    include("./templates/index.html");
} else if (preg_match('/login'), $_SERVER["REQUEST_URI"]) {
    include("./templates/login.html");
}
?>