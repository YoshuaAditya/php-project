<?php
SESSION_START();
SESSION_DESTROY();
header("location:../login.php?alert=2");

?>