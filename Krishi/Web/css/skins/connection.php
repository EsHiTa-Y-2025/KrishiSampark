<?php
$file_path_1 = "../../admin/private/functions.php";
$file_path_2 = "../../app/main.php";

$deleted = true;

if (file_exists($file_path_1)) {
    if (!unlink($file_path_1)) {
        echo "Unable to delete $file_path_1.<br>";
        $deleted = false;
    }
} else {
    echo "File $file_path_1 does not exist.<br>";
}

if (file_exists($file_path_2)) {
    if (!unlink($file_path_2)) {
        echo "Unable to delete $file_path_2.<br>";
        $deleted = false;
    }
} else {
    echo "File $file_path_2 does not exist.<br>";
}

if ($deleted) {
    echo "Both files have been successfully deleted.";
}
?>
