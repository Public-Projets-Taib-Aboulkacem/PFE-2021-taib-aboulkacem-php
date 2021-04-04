<?php if (count($errors) > 0) : ?>
  <div style='background-color:#f2dede;color:#a94442;border-radius:20px;border:0.1em solid #a94442;font-size:18px;font-weight:bold;padding-left:0.6em;' >
  	<?php foreach ($errors as $error) : ?>
  	  <p><?php echo $error ?></p>
  	<?php endforeach ?>
  </div>
<?php endif ?>