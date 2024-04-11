<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Pet Types
Breadcrumbs::for('home-admin', function (BreadcrumbTrail $trail) {
	$trail->push('Home', route('admin.index'));
});

Breadcrumbs::for('pet-type', function (BreadcrumbTrail $trail) {
	$trail->parent('home-admin');
	$trail->push('Pet Type', route('admin.petType.index'));
});

Breadcrumbs::for('pet-type-create', function (BreadcrumbTrail $trail) {
	$trail->parent('pet-type');
	$trail->push('Create', route('admin.petType.create'));
});

Breadcrumbs::for('pet-type-edit', function (BreadcrumbTrail $trail) {
	$trail->parent('pet-type');
	$trail->push('Update');
});