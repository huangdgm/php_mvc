<?php require_once APPROOT . '/views/inc/header.php'; ?>

<h1>index page</h1>
<h2><?php echo $data['title'] ?></h2>
<ul>
    <?php foreach($data['posts'] as $post) : ?>
        <li><?php echo $post->title; ?></li>
    <?php endforeach; ?>
</ul>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>