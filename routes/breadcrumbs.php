<?php

use App\Models\User;
use App\Models\Appointment;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use Spatie\Permission\Models\Role;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('dashboard'));
});

// Home > Dashboard
Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Dashboard', route('dashboard'));
});

// Home > Dashboard > Appointments
Breadcrumbs::for('admin.appointments.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Appointments', route('admin.appointments.index'));
});

// Home > Dashboard > Appointments > View
Breadcrumbs::for('admin.appointments.show', function (BreadcrumbTrail $trail, Appointment $appointment) {
    $trail->parent('admin.appointments.index');
    $trail->push('Appointment #' . $appointment->id, route('admin.appointments.show', $appointment));
});

// Home > Dashboard > Appointments > Edit
Breadcrumbs::for('admin.appointments.edit', function (BreadcrumbTrail $trail, Appointment $appointment) {
    $trail->parent('admin.appointments.index');
    $trail->push('Edit Appointment #' . $appointment->id, route('admin.appointments.edit', $appointment));
});

// Home > Dashboard > User Management
Breadcrumbs::for('user-management.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('User Management', route('user-management.users.index'));
});

// Home > Dashboard > User Management > Users
Breadcrumbs::for('user-management.users.index', function (BreadcrumbTrail $trail) {
    $trail->parent('user-management.index');
    $trail->push('Users', route('user-management.users.index'));
});

// Home > Dashboard > User Management > Users > [User]
Breadcrumbs::for('user-management.users.show', function (BreadcrumbTrail $trail, User $user) {
    $trail->parent('user-management.users.index');
    $trail->push(ucwords($user->name), route('user-management.users.show', $user));
});

// Home > Dashboard > User Management > Roles
Breadcrumbs::for('user-management.roles.index', function (BreadcrumbTrail $trail) {
    $trail->parent('user-management.index');
    $trail->push('Roles', route('user-management.roles.index'));
});

// Home > Dashboard > User Management > Roles > [Role]
Breadcrumbs::for('user-management.roles.show', function (BreadcrumbTrail $trail, Role $role) {
    $trail->parent('user-management.roles.index');
    $trail->push(ucwords($role->name), route('user-management.roles.show', $role));
});

// Home > Dashboard > User Management > Permission
Breadcrumbs::for('user-management.permissions.index', function (BreadcrumbTrail $trail) {
    $trail->parent('user-management.index');
    $trail->push('Permissions', route('user-management.permissions.index'));
});

// Home > Dashboard > Services
Breadcrumbs::for('admin.services.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Services', route('admin.services.index'));
});

// Home > Dashboard > Services > Create
Breadcrumbs::for('admin.services.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.services.index');
    $trail->push('Add Service', route('admin.services.create'));
});

// Home > Dashboard > Services > Edit
Breadcrumbs::for('admin.services.edit', function (BreadcrumbTrail $trail, $service) {
    $trail->parent('admin.services.index');
    $trail->push('Edit Service', route('admin.services.edit', $service));
});

// Home > Dashboard > Doctors
Breadcrumbs::for('admin.doctors.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Doctors', route('admin.doctors.index'));
});

// Home > Dashboard > Doctors > Create
Breadcrumbs::for('admin.doctors.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.doctors.index');
    $trail->push('Add Doctor', route('admin.doctors.create'));
});

// Home > Dashboard > Doctors > Edit
Breadcrumbs::for('admin.doctors.edit', function (BreadcrumbTrail $trail, $doctor) {
    $trail->parent('admin.doctors.index');
    $trail->push('Edit Doctor', route('admin.doctors.edit', $doctor));
});

// Home > Dashboard > Gallery
Breadcrumbs::for('admin.gallery.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Gallery', route('admin.gallery.index'));
});

// Home > Dashboard > Gallery > Create
Breadcrumbs::for('admin.gallery.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.gallery.index');
    $trail->push('Add Gallery Item', route('admin.gallery.create'));
});

// Home > Dashboard > Gallery > Edit
Breadcrumbs::for('admin.gallery.edit', function (BreadcrumbTrail $trail, $gallery) {
    $trail->parent('admin.gallery.index');
    $trail->push('Edit Gallery Item', route('admin.gallery.edit', $gallery));
});

// Home > Dashboard > Discounts
Breadcrumbs::for('admin.discounts.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Discounts', route('admin.discounts.index'));
});

// Home > Dashboard > Discounts > Create
Breadcrumbs::for('admin.discounts.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.discounts.index');
    $trail->push('Add Discount', route('admin.discounts.create'));
});

// Home > Dashboard > Discounts > Edit
Breadcrumbs::for('admin.discounts.edit', function (BreadcrumbTrail $trail, $discount) {
    $trail->parent('admin.discounts.index');
    $trail->push('Edit Discount', route('admin.discounts.edit', $discount));
});

// Home > Dashboard > Expert Tips
Breadcrumbs::for('admin.expert-tips.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Expert Tips', route('admin.expert-tips.index'));
});

// Home > Dashboard > Expert Tips > Create
Breadcrumbs::for('admin.expert-tips.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.expert-tips.index');
    $trail->push('Add Expert Tip', route('admin.expert-tips.create'));
});

// Home > Dashboard > Expert Tips > Edit
Breadcrumbs::for('admin.expert-tips.edit', function (BreadcrumbTrail $trail, $expertTip) {
    $trail->parent('admin.expert-tips.index');
    $trail->push('Edit Expert Tip', route('admin.expert-tips.edit', $expertTip));
});
