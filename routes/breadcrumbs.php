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
