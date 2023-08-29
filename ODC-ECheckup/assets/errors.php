<?php if (count($errors) > 0) : ?>
		<?php foreach ($errors as $error) : ?>
			<div class="alert alert-warning alert-dismissible fade show" role="alert">
				<strong>Error:</strong> <?php echo $error ?>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		<?php endforeach ?>
<?php endif ?>