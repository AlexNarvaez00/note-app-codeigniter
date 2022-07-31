<?= helper('html') ?>
<?= $this->extend('components/root') ?>
<!--Titutlo de la seccion-->
<?= $this->section('title-page') ?>
Note - <?= $note['id'] ?>
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
<div class="card">
	<div class="card-body">
		<h5 class="card-title">
			<?= $note['title'] ?>
		</h5>
		<p class="mb-0">
			<?= $note['content'] ?>
		</p>
		<span class="badge badge-light-secondary mt-5 mb-2 me-4">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar">
				<rect x="3" y="4" width="18" height="18" rx="2" ry="2">
				</rect>
				<line x1="16" y1="2" x2="16" y2="6">
				</line>
				<line x1="8" y1="2" x2="8" y2="6">
				</line>
				<line x1="3" y1="10" x2="21" y2="10">
				</line>
			</svg>
			<?= date('d M y', strtotime($note['created_at'])) ?>
		</span>
	</div>
</div>
<?= $this->endSection() ?>
<!-- END MAIN-->
<!--BEGIN SCRIPTS -->
<?= $this->section('script-section') ?>
<?= $this->endSection() ?>
<!--END SCRIPTS-->
