<?php
$spriteFile = __DIR__ . '/../assets/img/sprite.svg';
?>

<div style="display:none" aria-hidden="true">
  <?php
  if (is_file($spriteFile)) {
      readfile($spriteFile);
  }
  ?>
</div>
