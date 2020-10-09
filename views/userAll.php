<?php
/** @var \app\models\Users[] $users */
?>

<?php foreach ($users as $user) :?>
    <h2><?= $user->login ?></h2>
    <a href="?с=users&a=one&id=<?= $user->id?>">подробнее</a>
    <hr>
<?php endforeach;?>