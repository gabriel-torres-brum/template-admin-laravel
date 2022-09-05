<?php

use App\Models\User;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail): void {
    $trail->push('Início', route('dashboard'), ['icon' => 'home']);
});

Breadcrumbs::for('users.index', function (BreadcrumbTrail $trail): void {
    $trail->parent('dashboard');

    $trail->push('Usuários', route('users.index'), ['icon' => 'user']);
});
 
Breadcrumbs::for('users.create', function (BreadcrumbTrail $trail): void {
    $trail->parent('users.index');
 
    $trail->push('Incluir usuário', route('users.create'));
});
 
Breadcrumbs::for('users.edit', function (BreadcrumbTrail $trail, User $user): void {
    $trail->parent('users.index');
    
    $trail->push($user->name, route('users.edit', $user));
});