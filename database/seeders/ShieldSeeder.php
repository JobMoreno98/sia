<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use BezhanSalleh\FilamentShield\Support\Utils;
use Spatie\Permission\PermissionRegistrar;

class ShieldSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $rolesWithPermissions = '[{"name":"super_admin","guard_name":"web","permissions":
        ["view_departamentos","view_any_departamentos","create_departamentos","update_departamentos",
        "delete_departamentos","view_disciplinas","view_any_disciplinas","create_disciplinas",
        "update_disciplinas","delete_disciplinas","view_divisiones","view_any_divisiones",
        "create_divisiones","update_divisiones","delete_divisiones","view_programa::educativo",
        "view_any_programa::educativo","create_programa::educativo","update_programa::educativo",
        "delete_programa::educativo","view_role","view_any_role","create_role","update_role",
        "delete_role","delete_any_role","view_user","view_any_user","create_user","update_user","delete_user"]},{"name":"Admin","guard_name":"web","permissions":["view_departamentos","view_any_departamentos","create_departamentos","update_departamentos","delete_departamentos","view_disciplinas","view_any_disciplinas","create_disciplinas","update_disciplinas","delete_disciplinas","view_divisiones","view_any_divisiones","create_divisiones","update_divisiones","delete_divisiones","view_programa::educativo","view_any_programa::educativo","create_programa::educativo","update_programa::educativo","delete_programa::educativo","view_user","view_any_user","create_user","update_user","delete_user"]}]';
        $directPermissions = '[]';

        static::makeRolesWithPermissions($rolesWithPermissions);
        static::makeDirectPermissions($directPermissions);

        $this->command->info('Shield Seeding Completed.');
    }

    protected static function makeRolesWithPermissions(string $rolesWithPermissions): void
    {
        if (! blank($rolePlusPermissions = json_decode($rolesWithPermissions, true))) {
            /** @var Model $roleModel */
            $roleModel = Utils::getRoleModel();
            /** @var Model $permissionModel */
            $permissionModel = Utils::getPermissionModel();

            foreach ($rolePlusPermissions as $rolePlusPermission) {
                $role = $roleModel::firstOrCreate([
                    'name' => $rolePlusPermission['name'],
                    'guard_name' => $rolePlusPermission['guard_name'],
                ]);

                if (! blank($rolePlusPermission['permissions'])) {
                    $permissionModels = collect($rolePlusPermission['permissions'])
                        ->map(fn ($permission) => $permissionModel::firstOrCreate([
                            'name' => $permission,
                            'guard_name' => $rolePlusPermission['guard_name'],
                        ]))
                        ->all();

                    $role->syncPermissions($permissionModels);
                }
            }
        }
    }

    public static function makeDirectPermissions(string $directPermissions): void
    {
        if (! blank($permissions = json_decode($directPermissions, true))) {
            /** @var Model $permissionModel */
            $permissionModel = Utils::getPermissionModel();

            foreach ($permissions as $permission) {
                if ($permissionModel::whereName($permission)->doesntExist()) {
                    $permissionModel::create([
                        'name' => $permission['name'],
                        'guard_name' => $permission['guard_name'],
                    ]);
                }
            }
        }
    }
}
