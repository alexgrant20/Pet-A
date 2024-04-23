<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('home-admin', function (BreadcrumbTrail $trail) {
	$trail->push('Home', route('admin.index'));
});

Breadcrumbs::for('pet-type', function (BreadcrumbTrail $trail) {
	$trail->parent('home-admin');
	$trail->push('Pet Type', route('admin.master.pet-type.index'));
});

Breadcrumbs::for('pet-type-create', function (BreadcrumbTrail $trail) {
	$trail->parent('pet-type');
	$trail->push('Create', route('admin.master.pet-type.create'));
});

Breadcrumbs::for('pet-type-edit', function (BreadcrumbTrail $trail) {
	$trail->parent('pet-type');
	$trail->push('Update');
});

Breadcrumbs::for('breed', function (BreadcrumbTrail $trail) {
	$trail->parent('home-admin');
	$trail->push('Breed', route('admin.master.breed.index'));
});

Breadcrumbs::for('breed-create', function (BreadcrumbTrail $trail) {
	$trail->parent('breed');
	$trail->push('Create', route('admin.master.breed.create'));
});

Breadcrumbs::for('breed-edit', function (BreadcrumbTrail $trail) {
	$trail->parent('breed');
	$trail->push('Update');
});

Breadcrumbs::for('appointment-type', function (BreadcrumbTrail $trail) {
	$trail->parent('home-admin');
	$trail->push('Appointment Type', route('admin.master.appointment-type.index'));
});

Breadcrumbs::for('appointment-type-create', function (BreadcrumbTrail $trail) {
	$trail->parent('appointment-type');
	$trail->push('Create', route('admin.master.appointment-type.create'));
});

Breadcrumbs::for('appointment-type-edit', function (BreadcrumbTrail $trail) {
	$trail->parent('appointment-type');
	$trail->push('Update');
});

Breadcrumbs::for('city', function (BreadcrumbTrail $trail) {
	$trail->parent('home-admin');
	$trail->push('City', route('admin.master.city.index'));
});

Breadcrumbs::for('city-create', function (BreadcrumbTrail $trail) {
	$trail->parent('city');
	$trail->push('Create', route('admin.master.city.create'));
});

Breadcrumbs::for('city-edit', function (BreadcrumbTrail $trail) {
	$trail->parent('city');
	$trail->push('Update');
});

Breadcrumbs::for('province', function (BreadcrumbTrail $trail) {
	$trail->parent('home-admin');
	$trail->push('Province', route('admin.master.province.index'));
});

Breadcrumbs::for('province-create', function (BreadcrumbTrail $trail) {
	$trail->parent('province');
	$trail->push('Create', route('admin.master.province.create'));
});

Breadcrumbs::for('province-edit', function (BreadcrumbTrail $trail) {
	$trail->parent('province');
	$trail->push('Update');
});

Breadcrumbs::for('medication-type', function (BreadcrumbTrail $trail) {
	$trail->parent('home-admin');
	$trail->push('Medication Type', route('admin.master.medication-type.index'));
});

Breadcrumbs::for('medication-type-create', function (BreadcrumbTrail $trail) {
	$trail->parent('medication-type');
	$trail->push('Create', route('admin.master.medication-type.create'));
});

Breadcrumbs::for('medication-type-edit', function (BreadcrumbTrail $trail) {
	$trail->parent('medication-type');
	$trail->push('Update');
});

Breadcrumbs::for('payment-type', function (BreadcrumbTrail $trail) {
	$trail->parent('home-admin');
	$trail->push('Payment Type', route('admin.master.payment-type.index'));
});

Breadcrumbs::for('payment-type-create', function (BreadcrumbTrail $trail) {
	$trail->parent('payment-type');
	$trail->push('Create', route('admin.master.payment-type.create'));
});

Breadcrumbs::for('payment-type-edit', function (BreadcrumbTrail $trail) {
	$trail->parent('payment-type');
	$trail->push('Update');
});

Breadcrumbs::for('vaccination-type', function (BreadcrumbTrail $trail) {
	$trail->parent('home-admin');
	$trail->push('Vaccination Type', route('admin.master.vaccination-type.index'));
});

Breadcrumbs::for('vaccination-type-create', function (BreadcrumbTrail $trail) {
	$trail->parent('vaccination-type');
	$trail->push('Create', route('admin.master.vaccination-type.create'));
});

Breadcrumbs::for('vaccination-type-edit', function (BreadcrumbTrail $trail) {
	$trail->parent('vaccination-type');
	$trail->push('Update');
});