<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';

    $data = [
        'name' => $name,
        'email' => $email,
        'eco_bag' => isset($_POST['eco_bag']) ? 1 : 0,
        'my_bottle' => isset($_POST['my_bottle']) ? 1 : 0,
        'walking_bike' => isset($_POST['walking_bike']) ? 1 : 0,
        'power_bike' => isset($_POST['power_bike']) ? 1 : 0
    ];

    $json_data = json_encode($data);
    
    // data.json にデータを追記
    file_put_contents('data.json', $json_data . PHP_EOL, FILE_APPEND);

    // リダイレクト
    header('Location: read.php');
    exit();
}
?>
