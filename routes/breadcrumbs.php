<?php

use App\Models\EcclesiasticalRole;
use App\Models\FinancialTransaction;
use App\Models\Person;
use App\Models\User;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

if (tenant()) {

    Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail): void {
        $trail->push('Início', tenantRoute('dashboard'), ['icon' => 'home']);
    });

    Breadcrumbs::for('config', function (BreadcrumbTrail $trail): void {
        $trail->parent('dashboard');
    
        $trail->push('Configurações', tenantRoute('config'), ['icon' => 'cog']);
    });

    // -- Relatórios Financeiros --
    Breadcrumbs::for('financialReports.index', function (BreadcrumbTrail $trail): void {
        $trail->parent('dashboard');
    
        $trail->push('Relatórios financeiros', tenantRoute('financialReports.index'), ['icon' => 'clipboard-document']);
    });

    Breadcrumbs::for('financialReports.create', function (BreadcrumbTrail $trail): void {
        $trail->parent('financialReports.index');
     
        $trail->push('Criar relatório financeiro', tenantRoute('financialReports.create'));
    });

    // -- Transações Financeiras --
    Breadcrumbs::for('financialTransactions.index', function (BreadcrumbTrail $trail): void {
        $trail->parent('dashboard');
    
        $trail->push('Transações financeiras', tenantRoute('financialTransactions.index'), ['icon' => 'currency-dollar']);
    });

    Breadcrumbs::for('financialTransactions.create', function (BreadcrumbTrail $trail): void {
        $trail->parent('financialTransactions.index');
     
        $trail->push('Incluir transações financeiras', tenantRoute('financialTransactions.create'));
    });

    Breadcrumbs::for('financialTransactions.edit', function (BreadcrumbTrail $trail): void {
        $trail->parent('financialTransactions.index');

        $financialTransaction = request()->financialTransaction;
     
        $trail->push($financialTransaction->description, tenantRoute('financialTransactions.edit', ['financialTransaction' => $financialTransaction]));
    });

    // -- Usuários --
    Breadcrumbs::for('users.index', function (BreadcrumbTrail $trail): void {
        $trail->parent('dashboard');
    
        $trail->push('Usuários', tenantRoute('users.index'), ['icon' => 'user-circle']);
    });
     
    Breadcrumbs::for('users.create', function (BreadcrumbTrail $trail): void {
        $trail->parent('users.index');
     
        $trail->push('Incluir usuário', tenantRoute('users.create'));
    });
     
    Breadcrumbs::for('users.edit', function (BreadcrumbTrail $trail): void {
        $user = request()->user;
        $trail->parent('users.index');
        
        $trail->push($user->name, tenantRoute('users.edit', ['user' => $user]));
    });

    // -- Membros --
    Breadcrumbs::for('people.index', function (BreadcrumbTrail $trail): void {
        $trail->parent('dashboard');
    
        $trail->push('Membros', tenantRoute('people.index'), ['icon' => 'users']);
    });

    Breadcrumbs::for('people.create', function (BreadcrumbTrail $trail): void {
        $trail->parent('people.index');
     
        $trail->push('Incluir membro', tenantRoute('people.create'));
    });
     
    Breadcrumbs::for('people.edit', function (BreadcrumbTrail $trail): void {
        $trail->parent('people.index');

        $person = request()->person;
        
        $trail->push($person->name, tenantRoute('people.edit', ['person' => $person]));
    });

    // -- Cargos eclesiásticos --
    Breadcrumbs::for('ecclesiasticalRoles.index', function (BreadcrumbTrail $trail): void {
        $trail->parent('dashboard');
    
        $trail->push('Membros', tenantRoute('ecclesiasticalRoles.index'), ['icon' => 'users']);
    });

    Breadcrumbs::for('ecclesiasticalRoles.create', function (BreadcrumbTrail $trail): void {
        $trail->parent('ecclesiasticalRoles.index');
     
        $trail->push('Incluir membro', tenantRoute('ecclesiasticalRoles.create'));
    });
     
    Breadcrumbs::for('ecclesiasticalRoles.edit', function (BreadcrumbTrail $trail): void {
        $trail->parent('ecclesiasticalRoles.index');

        $ecclesiasticalRole = request()->ecclesiasticalRole;
        
        $trail->push($ecclesiasticalRole->name, tenantRoute('ecclesiasticalRoles.edit', ['ecclesiasticalRole' => $ecclesiasticalRole]));
    });

} else {

    Breadcrumbs::for('admin.dashboard', function (BreadcrumbTrail $trail): void {
        $trail->push('Início', tenantRoute('admin.dashboard'), ['icon' => 'home']);
    });
    
    // Breadcrumbs::for('users.index', function (BreadcrumbTrail $trail): void {
    //     $trail->parent('dashboard');
    
    //     $trail->push('Usuários', tenantRoute('users.index'), ['icon' => 'user']);
    // });
     
    // Breadcrumbs::for('users.create', function (BreadcrumbTrail $trail): void {
    //     $trail->parent('users.index');
     
    //     $trail->push('Incluir usuário', tenantRoute('users.create'));
    // });
     
    // Breadcrumbs::for('users.edit', function (BreadcrumbTrail $trail, User $user): void {
    //     $trail->parent('users.index');
        
    //     $trail->push($user->name, tenantRoute('users.edit', $user));
    // });

}