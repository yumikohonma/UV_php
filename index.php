<?php
require 'db.php';

// 投稿処理
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '匿名';
    $category = $_POST['category'] ?? '未分類';
    $content = $_POST['content'] ?? '';

    if ($content !== '') {
        $stmt = $pdo->prepare("INSERT INTO posts (name, category, content) VALUES (?, ?, ?)");
        $stmt->execute([$name, $category, $content]);
    }
}

// 投稿一覧取得
$stmt = $pdo->query("SELECT * FROM posts ORDER BY created_at DESC");
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Union Voice - Prototype</title>
</head>
<body>
    <h1>Union Voice</h1>

    <form method="post">
        <p>
            名前: <input type="text" name="name" placeholder="匿名可">
            カテゴリ: <input type="text" name="category" placeholder="例: 働き方">
        </p>
        <p>
            <textarea name="content" rows="4" cols="50" placeholder="職場の声を入力してください"></textarea>
        </p>
        <p><button type="submit">投稿する</button></p>
    </form>

    <hr>

    <h2>投稿一覧</h2>
    <?php foreach ($posts as $post): ?>
        <div style="margin-bottom: 1em; border: 1px solid #ccc; padding: 10px;">
            <strong><?= htmlspecialchars($post['name']) ?>（<?= htmlspecialchars($post['category']) ?>）</strong><br>
            <?= nl2br(htmlspecialchars($post['content'])) ?><br>
            <small><?= $post['created_at'] ?></small>
        </div>
    <?php endforeach; ?>
</body>
</html>
