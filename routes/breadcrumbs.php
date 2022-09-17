<?php

use App\Models\EcclesiasticalRole;
use App\Models\Person;
use App\Models\User;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

if (tenant()) {

    Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail): void {
        $trail->push('Início', route('dashboard'), ['icon' => 'home']);
    });

    Breadcrumbs::for('config', function (BreadcrumbTrail $trail): void {
        $trail->parent('dashboard');
    
        $trail->push('Configurações', route('config'), ['icon' => 'cog']);
    });

    // -- Transações Financeiras --
    Breadcrumbs::for('financialTransactions.index', function (BreadcrumbTrail $trail): void {
        $trail->parent('dashboard');
    
        $trail->push('Transações financeiras', route('financialTransactions.index'), ['icon' => 'currency-dollar']);
    });

    Breadcrumbs::for('financialTransactions.create', function (BreadcrumbTrail $trail): void {
        $trail->parent('financialTransactions.index');
     
        $trail->push('Incluir transações financeiras', route('financialTransactions.create'));
    });

    // -- Usuários --
    Breadcrumbs::for('users.index', function (BreadcrumbTrail $trail): void {
        $trail->parent('dashboard');
    
        $trail->push('Usuários', route('users.index'), ['icon' => 'user-circle']);
    });
     
    Breadcrumbs::for('users.create', function (BreadcrumbTrail $trail): void {
        $trail->parent('users.index');
     
        $trail->push('Incluir usuário', route('users.create'));
    });
     
    Breadcrumbs::for('users.edit', function (BreadcrumbTrail $trail, User $user): void {
        $trail->parent('users.index');
        
        $trail->push($user->name, route('users.edit', $user));
    });

    // -- Membros --
    Breadcrumbs::for('people.index', function (BreadcrumbTrail $trail): void {
        $trail->parent('dashboard');
    
        $trail->push('Membros', route('people.index'), ['icon' => 'users']);
    });

    Breadcrumbs::for('people.create', function (BreadcrumbTrail $trail): void {
        $trail->parent('people.index');
     
        $trail->push('Incluir membro', route('people.create'));
    });
     
    Breadcrumbs::for('people.edit', function (BreadcrumbTrail $trail, Person $person): void {
        $trail->parent('people.index');
        
        $trail->push($person->name, route('people.edit', $person));
    });

    // -- Cargos eclesiásticos --
    Breadcrumbs::for('ecclesiasticalRoles.index', function (BreadcrumbTrail $trail): void {
        $trail->parent('dashboard');
    
        $trail->push('Membros', route('ecclesiasticalRoles.index'), ['icon' => 'users']);
    });

    Breadcrumbs::for('ecclesiasticalRoles.create', function (BreadcrumbTrail $trail): void {
        $trail->parent('ecclesiasticalRoles.index');
     
        $trail->push('Incluir membro', route('ecclesiasticalRoles.create'));
    });
     
    Breadcrumbs::for('ecclesiasticalRoles.edit', function (BreadcrumbTrail $trail, EcclesiasticalRole $ecclesiasticalRole): void {
        $trail->parent('ecclesiasticalRoles.index');
        
        $trail->push($ecclesiasticalRole->name, route('ecclesiasticalRoles.edit', $ecclesiasticalRole));
    });

} else {

    Breadcrumbs::for('admin.dashboard', function (BreadcrumbTrail $trail): void {
        $trail->push('Início', route('admin.dashboard'), ['icon' => 'home']);
    });
    
    // Breadcrumbs::for('users.index', function (BreadcrumbTrail $trail): void {
    //     $trail->parent('dashboard');
    
    //     $trail->push('Usuários', route('users.index'), ['icon' => 'user']);
    // });
     
    // Breadcrumbs::for('users.create', function (BreadcrumbTrail $trail): void {
    //     $trail->parent('users.index');
     
    //     $trail->push('Incluir usuário', route('users.create'));
    // });
     
    // Breadcrumbs::for('users.edit', function (BreadcrumbTrail $trail, User $user): void {
    //     $trail->parent('users.index');
        
    //     $trail->push($user->name, route('users.edit', $user));
    // });

}