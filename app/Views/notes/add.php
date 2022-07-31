<?= helper('html') ?>
<?= helper('form') ?>
<?= $this->extend('components/root') ?>
<!--Titutlo de la seccion-->
<?= $this->section('title-page') ?>
Add Notes
<?= $this->endSection() ?>
<!-- BEGIN INDEX-->
<?= $this->section('indexes-page') ?>
<?php foreach ($indexList as $index) : ?>
	<li class="breadcrumb-item">
		<a href="#">
			<?= $index['name'] ?>
		</a>
	</li>
<?php endforeach; ?>
<?= $this->endSection() ?>
<!-- END INDEX-->
<!-- BEGIN MAIN-->
<?= $this->section('main-content') ?>
<form action="<?= base_url('/notes') ?>" method="POST">
	<?= csrf_field() ?>
	<div class="form-row">
		<div class="col-md-12 mb-4">
			<div class="form-group mb-4">
				<label for="formGroupExampleInput">Titulo</label>
				<input type="text" class="form-control" name="title" value="<?= old('title') ?>" id="formGroupExampleInput" placeholder="Titulo" required>
				<?php if ($validation->hasError('title')) : ?>
					<div class="invalid-feedback d-flex">
						<?= $validation->getError('title') ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="form-row">
		<div class="col-md-12 mb-4">
			<div class="form-group mb-4">
				<label for="formGroupExampleInput2">Contenido</label>
				<textarea id="formGroupExampleInput2" placeholder="Contenido" class="form-control" name="content" cols="10" rows="5">
<?= old('content') ?>
</textarea>
			</div>
			<?php if ($validation->hasError('content')) : ?>
				<div class="invalid-feedback d-flex">
					<?= $validation->getError('content') ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
	<input type="submit" name="time" class="btn btn-primary">
</form>

<?= $this->endSection() ?>
<!-- END MAIN-->
<!--BEGIN SCRIPTS -->
<?= $this->section('script-section') ?>
<?= $this->endSection() ?>
<!--END SCRIPTS-->
