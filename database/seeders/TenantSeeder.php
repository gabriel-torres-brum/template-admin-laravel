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
            'id' => 'igreja1',
            'name' => 'Assembleia de Deus Ministério Palavra e Vida',
            'cnpj' => '11111111111111',
        ]);

        $tenant1->domains()
            ->create([
                'domain' => $tenant1->id . '.localhost'
            ]);

        $tenant2 = \App\Models\Tenant::create([
            'id' => 'igreja2',
            'name' => 'Assembleia de Deus Ministério Monte Moriá',
            'cnpj' => '22222222222222',
        ]);

        $tenant2->domains()
            ->create([
                'domain' => $tenant2->id . '.localhost'
            ]);
    }
}
