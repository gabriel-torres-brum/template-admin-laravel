<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tenant1 = \App\Models\Tenant::create([
            'id' => 'adpv',
            'name' => 'Assembleia de Deus Ministério Palavra e Vida',
            'cnpj' => '11111111111111',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Gabriel Torres Brum',
            'email' => 'gtorresbrum@gmail.com',
            'tenant_id' => $tenant1->id
        ]);

        \App\Models\EcclesiasticalRole::factory(5)->create([
            'tenant_id' => $tenant1->id
        ]);

        $tenant2 = \App\Models\Tenant::create([
            'id' => 'admm',
            'name' => 'Assembleia de Deus Ministério Monte Moriá',
            'cnpj' => '22222222222222',
        ]);

        \App\Models\EcclesiasticalRole::factory(5)->create([
            'tenant_id' => $tenant2->id
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Gabriel Torres Brum',
            'email' => 'gtorresbrum@hotmail.com',
            'tenant_id' => $tenant2->id
        ]);
    }
}
