<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create roles and assign existing permissions
        $role1 = Role::create([
            'name' => 'Admin',
            'description' => 'Usuário super administrador. Acesso total, inclusive administra usuários e permissões.'
        ]);
        $role2 = Role::create([
            'name' => 'User',
            'description' => 'Usuário com amplos poderes no sistema, com exceção na administração de usuários e permissões.'
        ]); 
        $role3 = Role::create([
            'name' => 'Basico',
            'description' => 'Usuário com poucas permissões, apenas consultar.'
        ]); 

        $user_admin = User::find(1);
        //Associa o usuário criado ao Role/Função Admin.
        $user_admin->assignRole('Admin');
        /**
         * ### CRIAR PERMISSÕES ########################
         * Além de criar as permissões, já lhe atribui funções através do método syncRoles()
        */

        // ### SEGURANÇA: 
        // Administrar funções da aplicação
        Permission::create([
            'name'          => 'admin.roles.index',
            'description'   => 'Ver funções',
            'model'         => 'admin_seg_role',
        ])->syncRoles([$role1]);
        Permission::create([
            'name'          => 'admin.roles.edit',
            'description'   => 'Editar funções',
            'model'         => 'admin_seg_role',
        ])->syncRoles([$role1]);
        Permission::create([
            'name'          => 'admin.roles.delete',
            'description'   => 'Deletar funções',
            'model'         => 'admin_seg_role',
        ])->syncRoles([$role1]);
        Permission::create([
            'name'          => 'admin.roles.create',
            'description'   => 'Criar funções',
            'model'         => 'admin_seg_role',
        ])->syncRoles([$role1]);

        // Administrar permissões da aplicação
        Permission::create([
            'name'          => 'admin.permissions.index',
            'description'   => 'Ver permissões',
            'model'         => 'admin_seg_permission',
        ])->syncRoles([$role1]);
        Permission::create([
            'name'          => 'admin.permissions.edit',
            'description'   => 'Editar permissões',
            'model'         => 'admin_seg_permission',
        ])->syncRoles([$role1]);
        Permission::create([
            'name'          => 'admin.permissions.delete',
            'description'   => 'Deletar permissões',
            'model'         => 'admin_seg_permission',
        ])->syncRoles([$role1]);
        Permission::create([
            'name'          => 'admin.permissions.create',
            'description'   => 'Criar permissões',
            'model'         => 'admin_seg_permission',
        ])->syncRoles([$role1]);

        // Administrar atribuições de funções(permissões) a usuários
        Permission::create([
            'name'          => 'admin.users.index',
            'description'   => 'Ver funções de usuários',
            'model'         => 'admin_seg_user_to_role',
        ])->syncRoles([$role1]);
        Permission::create([
            'name'          => 'admin.users.edit',
            'description'   => 'Editar funções de usuários',
            'model'         => 'admin_seg_user_to_role',
        ])->syncRoles([$role1]);
        Permission::create([
            'name'          => 'admin.users.delete',
            'description'   => 'Deletar funções de usuários',
            'model'         => 'admin_seg_user_to_role',
        ])->syncRoles([$role1]);


        // ### GRUPO: LANÇAMENTO
        // Acesso aos Grupos de Lançamento
        Permission::create([
            'name'          => 'fatura.grupos.index',
            'description'   => 'Ver Grupos de Fatura',
            'model'         => 'fatura_grupo',
        ])->syncRoles([$role2]);
        Permission::create([
            'name'          => 'fatura.grupos.create',
            'description'   => 'Criar Grupos de Fatura',
            'model'         => 'fatura_grupo',
        ])->syncRoles([$role2]);
        Permission::create([
            'name'          => 'fatura.grupos.edit',
            'description'   => 'Editar Grupos de Fatura',
            'model'         => 'fatura_grupo',
        ])->syncRoles([$role2]);
        Permission::create([
            'name'          => 'fatura.grupos.delete',
            'description'   => 'Deletar Grupos de Fatura',
            'model'         => 'fatura_grupo',
        ])->syncRoles([$role2]);

        Permission::create([
            'name'          => 'fatura.emissoras.index',
            'description'   => 'Ver Emissoras de Fatura',
            'model'         => 'fatura_emissora',
        ])->syncRoles([$role2]);
        Permission::create([
            'name'          => 'fatura.emissoras.create',
            'description'   => 'Criar Emissoras de Fatura',
            'model'         => 'fatura_emissora',
        ])->syncRoles([$role2]);
        Permission::create([
            'name'          => 'fatura.emissoras.edit',
            'description'   => 'Editar Emissoras de Fatura',
            'model'         => 'fatura_emissora',
        ])->syncRoles([$role2]);
        Permission::create([
            'name'          => 'fatura.emissoras.delete',
            'description'   => 'Deletar Emissoras de Fatura',
            'model'         => 'fatura_emissora',
        ])->syncRoles([$role2]);
    }
}
