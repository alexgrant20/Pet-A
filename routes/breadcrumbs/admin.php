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

Breadcrumbs::for('vaccination', function (BreadcrumbTrail $trail) {
	$trail->parent('home-admin');
	$trail->push('Vaccination', route('admin.master.vaccination.index'));
});

Breadcrumbs::for('vaccination-create', function (BreadcrumbTrail $trail) {
	$trail->parent('vaccination');
	$trail->push('Create', route('admin.master.vaccination.create'));
});

Breadcrumbs::for('vaccination-edit', function (BreadcrumbTrail $trail) {
	$trail->parent('vaccination');
	$trail->push('Update');
});

Breadcrumbs::for('user-management', function (BreadcrumbTrail $trail) {
	$trail->parent('home-admin');
	$trail->push('User Management', route('admin.user-management.index'));
});

Breadcrumbs::for('user-management-create', function (BreadcrumbTrail $trail) {
	$trail->parent('user-management');
	$trail->push('Add Veterinarian', route('admin.user-management.create'));
});

Breadcrumbs::for('user-management-edit', function (BreadcrumbTrail $trail) {
	$trail->parent('user-management');
	$trail->push('Edit Veterinarian');
});

Breadcrumbs::for('user-management-change-password', function (BreadcrumbTrail $trail) {
	$trail->parent('user-management');
	$trail->push('Change Password');
});

Breadcrumbs::for('service-price', function (BreadcrumbTrail $trail) {
	$trail->parent('home-admin');
	$trail->push('Service', route('admin.service-price.index'));
});

Breadcrumbs::for('service-price-create', function (BreadcrumbTrail $trail) {
	$trail->parent('service-price');
	$trail->push('Add Service', route('admin.service-price.create'));
});

Breadcrumbs::for('service-price-edit', function (BreadcrumbTrail $trail) {
	$trail->parent('service-price');
	$trail->push('Edit Service');
});

Breadcrumbs::for('appointment-schedule', function (BreadcrumbTrail $trail) {
	$trail->parent('home-admin');
	$trail->push('Veterinarian Schedule', route('admin.appointment-schedule.index'));
});

Breadcrumbs::for('appointment-schedule-create', function (BreadcrumbTrail $trail) {
	$trail->parent('appointment-schedule');
	$trail->push('Add Veterinarian Schedule', route('admin.appointment-schedule.create'));
});

Breadcrumbs::for('appointment-schedule-edit', function (BreadcrumbTrail $trail) {
	$trail->parent('appointment-schedule');
	$trail->push('Edit Veterinarian Schedule');
});

Breadcrumbs::for('clinic', function (BreadcrumbTrail $trail) {
	$trail->parent('home-admin');
	$trail->push('Clinic', route('admin.clinic.index'));
});

Breadcrumbs::for('clinic-create', function (BreadcrumbTrail $trail) {
	$trail->parent('clinic');
	$trail->push('Add Clinic', route('admin.clinic.create'));
});

Breadcrumbs::for('clinic-edit', function (BreadcrumbTrail $trail) {
	$trail->parent('clinic');
	$trail->push('Edit Clinic');
});

Breadcrumbs::for('appointment', function (BreadcrumbTrail $trail) {
	$trail->parent('home-admin');
	$trail->push('Appointment', route('admin.appointment.index'));
});

Breadcrumbs::for('appointment-edit', function (BreadcrumbTrail $trail) {
	$trail->parent('home-admin');
	$trail->push('Appointment', route('admin.appointment.index'));
});

Breadcrumbs::for('appointment-show', function (BreadcrumbTrail $trail) {
	$trail->parent('appointment');
	$trail->push('Appointment Detail');
});

Breadcrumbs::for('appointment-summary', function (BreadcrumbTrail $trail) {
	$trail->parent('appointment');
	$trail->push('Appointment Summary');
});

Breadcrumbs::for('veterinarian', function (BreadcrumbTrail $trail) {
	$trail->parent('home-admin');
	$trail->push('Veterinarian', route('admin.veterinarian.index'));
});

Breadcrumbs::for('veterinarian-create', function (BreadcrumbTrail $trail) {
	$trail->parent('veterinarian');
	$trail->push('Add Veterinarian', route('admin.veterinarian.create'));
});

Breadcrumbs::for('veterinarian-edit', function (BreadcrumbTrail $trail) {
	$trail->parent('veterinarian');
	$trail->push('Edit Veterinarian');
});

Breadcrumbs::for('user-support', function (BreadcrumbTrail $trail) {
	$trail->parent('home-admin');
	$trail->push('User Support', route('admin.chat.index'));
});
