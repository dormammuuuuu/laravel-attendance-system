<?php

use Carbon\Carbon;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('Dashboard', route('admin.dashboard'));
});

Breadcrumbs::for('professor-dashboard', function ($trail) {
    $trail->push('Dashboard', route('professors.dashboard'));
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

Breadcrumbs::for('archived', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Archived', route('admin.archived'));
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
    $trail->push($firstname . ', ' . $lastname . ' ' . $middleinitial, route('admin.professors.profile', [$firstname, $lastname, $middleinitial]));
});

Breadcrumbs::for('archived-profile', function ($trail, $firstname, $lastname, $middleinitial) {
    $trail->parent('archived');
    $trail->push($firstname . ', ' . $lastname . ' ' . $middleinitial, route('admin.archived.profile', [$firstname, $lastname, $middleinitial]));
});

Breadcrumbs::for('class', function ($trail, $subject) {
    $trail->parent('classes');
    $trail->push($subject->class_name . ' - ' . $subject->class_section . ' ('. $subject->class_school_year .')');
});

Breadcrumbs::for('professor-class', function($trail, $subject) {
    $token = $subject->class_token;
    $trail->parent('professor-dashboard');
    $trail->push($subject->class_name . ' - ' . $subject->class_section . ' ('. $subject->class_school_year .')', route('professors.class.dashboard', $token));
});

Breadcrumbs::for('master-list', function($trail, $subject) {
    $trail->parent('professor-class', $subject);
    $trail->push('View Class');
});

Breadcrumbs::for('calendar', function($trail, $subject) {
    $trail->parent('professor-class', $subject);
    $trail->push('Class Calendar', route('professors.class.calendar', $subject->class_token));
});

Breadcrumbs::for('calendar-daily', function($trail, $subject, $date) {
    $trail->parent('calendar', $subject);
    $formalDate = Carbon::parse($date)->format('F d, Y');
    $trail->push($formalDate);
});

Breadcrumbs::for('professor-session', function($trail, $subject,) {
    $trail->parent('professor-class', $subject);
    $trail->push("Session");
});

