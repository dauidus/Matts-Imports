<?php
//Small script to show content of the generated files
$fileContent = file_get_contents($_GET['file']);
echo htmlentities($fileContent);
?>