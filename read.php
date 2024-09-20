<?php
$json_data = file_get_contents('data.json');
$responses = explode(PHP_EOL, $json_data);

// 初期化
$eco_bag_count = 0;
$my_bottle_count = 0;
$walking_bike_count = 0;
$power_bike_count = 0;

foreach ($responses as $response) {
    if ($response) {
        $data = json_decode($response, true);

        // 各項目をカウント
        $eco_bag_count += $data['eco_bag'];
        $my_bottle_count += $data['my_bottle'];
        $walking_bike_count += $data['walking_bike'];
        $power_bike_count += $data['power_bike'];
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>アンケート結果</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>アンケート結果</h1>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>名前</th>
            <th>メールアドレス</th>
            <th>エコバッグを使っている</th>
            <th>マイボトルを使っている</th>
            <th>自転車や徒歩で移動している</th>
            <th>発電バイクで運動したい</th>
        </tr>

        <?php foreach ($responses as $response): ?>
            <?php if ($response): ?>
                <?php $data = json_decode($response, true); ?>
                <tr>
                    <td><?= htmlspecialchars($data['name']) ?></td>
                    <td><?= htmlspecialchars($data['email']) ?></td>
                    <td><?= $data['eco_bag'] ? 'はい' : 'いいえ' ?></td>
                    <td><?= $data['my_bottle'] ? 'はい' : 'いいえ' ?></td>
                    <td><?= $data['walking_bike'] ? 'はい' : 'いいえ' ?></td>
                    <td><?= $data['power_bike'] ? 'はい' : 'いいえ' ?></td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
    </table>

    <h2>アンケート結果のチャート表示</h2>
    <canvas id="myChart"></canvas>

    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['エコバッグを使っている', 'マイボトルを使っている', '自転車や徒歩で移動している', '発電バイクで運動したい'],
                datasets: [{
                    label: '回答数',
                    data: [<?= $eco_bag_count ?>, <?= $my_bottle_count ?>, <?= $walking_bike_count ?>, <?= $power_bike_count ?>],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
