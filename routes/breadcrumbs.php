<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('Dashboard', route('admin.dashboard'));
});

Breadcrumbs::for('students', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Students', route('admin.students'));
});

Breadcrumbs::for('admin', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Administrator', route('admin.admins'));
});

Breadcrumbs::for('professors', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Professors', route('admin.professors'));
});

Breadcrumbs::for('registrations', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Registration Requests', route('admin.registrations'));
});

Breadcrumbs::for('classes', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Classes', route('admin.classes'));
});

Breadcrumbs::for('professor-profile', function ($trail, $firstname, $lastname, $middleinitial) {
    $trail->parent('professors');
    $trail->push($firstname . ', ' . $lastname . ' ' . $middleinitial . '.', route('admin.professors.profile', [$firstname, $lastname, $middleinitial]));
});

Breadcrumbs::for('class', function ($trail, $subject) {
    $trail->parent('classes');
    $trail->push($subject->class_name);
});

