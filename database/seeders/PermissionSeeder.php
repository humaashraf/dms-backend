<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'dashboard',
            'donations',
            'donations_list',
            'donations_create',
            'donations_edit',
            'donations_delete',
            'donations_show',
            'wire_transfers_list',
            'wire_transfers_create',
            'wire_transfers_edit',
            'wire_transfers_delete',
            'wire_transfers_show',
            'expenses',
            'expenses_list',
            'expenses_create',
            'expenses_edit',
            'expenses_delete',
            'expenses_show',
            'reports',
            'user',
            'user_list',
            'user_create',
            'user_edit',
            'user_delete',
            'user_show',
            'bank_accounts',
            'bank_accounts_list',
            'bank_accounts_create',
            'bank_accounts_edit',
            'bank_accounts_delete',
            'bank_accounts_show',
            'donation_categories',
            'donation_categories_list',
            'donation_categories_create',
            'donation_categories_edit',
            'donation_categories_delete',
            'donation_categories_show',
            'expense_categories',
            'expense_categories_list',
            'expense_categories_create',
            'expense_categories_edit',
            'expense_categories_delete',
            'expense_categories_show',
            'roles_and_permissions',
            'roles',
            'roles_list',
            'roles_create',
            'roles_edit',
            'roles_delete',
            'roles_show',
            'permissions',
            'permissions_list',
            'permissions_create',
            'permissions_edit',
            'permissions_delete',
            'permissions_show',
            'settings',
            'general_settings',
            'general_settings_list',
            'general_settings_create',
            'general_settings_edit',
            'general_settings_delete',
            'general_settings_show',
            'email_settings',
            'email_settings_list',
            'email_settings_create',
            'email_settings_edit',
            'email_settings_delete',
            'email_settings_show',
            'currencies',
            'currencies_list',
            'currencies_create',
            'currencies_edit',
            'currencies_delete',
            'currencies_show',
        ];

        foreach ($permissions as $permission){
            Permission::create(['name' => $permission]);
        }
    }
}
