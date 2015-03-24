<?php
include 'class/Lang.php';
include 'config/config.php';

Lang::init();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Multi Language Basic</title>
</head>
<body>

<a href="<?php echo BASE_URI;?>pt">PT</a>
<a href="<?php echo BASE_URI;?>en">EN</a>

<section>
  <header>
    <h2> <?php echo Lang::get('title'); ?> </h2>
    <h3> <?php echo Lang::get('subtitle'); ?></h3>
  </header>
  <article>
    <?php echo Lang::get('article'); ?>
  </article>
</section>


</body>
</html>