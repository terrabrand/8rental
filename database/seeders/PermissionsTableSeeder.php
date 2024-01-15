<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 18,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 19,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 20,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 21,
                'title' => 'contact_access',
            ],
            [
                'id'    => 22,
                'title' => 'landlord_create',
            ],
            [
                'id'    => 23,
                'title' => 'landlord_edit',
            ],
            [
                'id'    => 24,
                'title' => 'landlord_show',
            ],
            [
                'id'    => 25,
                'title' => 'landlord_delete',
            ],
            [
                'id'    => 26,
                'title' => 'landlord_access',
            ],
            [
                'id'    => 27,
                'title' => 'tenant_create',
            ],
            [
                'id'    => 28,
                'title' => 'tenant_edit',
            ],
            [
                'id'    => 29,
                'title' => 'tenant_show',
            ],
            [
                'id'    => 30,
                'title' => 'tenant_delete',
            ],
            [
                'id'    => 31,
                'title' => 'tenant_access',
            ],
            [
                'id'    => 32,
                'title' => 'properties_menu_access',
            ],
            [
                'id'    => 33,
                'title' => 'property_create',
            ],
            [
                'id'    => 34,
                'title' => 'property_edit',
            ],
            [
                'id'    => 35,
                'title' => 'property_show',
            ],
            [
                'id'    => 36,
                'title' => 'property_delete',
            ],
            [
                'id'    => 37,
                'title' => 'property_access',
            ],
            [
                'id'    => 38,
                'title' => 'section_create',
            ],
            [
                'id'    => 39,
                'title' => 'section_edit',
            ],
            [
                'id'    => 40,
                'title' => 'section_show',
            ],
            [
                'id'    => 41,
                'title' => 'section_delete',
            ],
            [
                'id'    => 42,
                'title' => 'section_access',
            ],
            [
                'id'    => 43,
                'title' => 'unit_create',
            ],
            [
                'id'    => 44,
                'title' => 'unit_edit',
            ],
            [
                'id'    => 45,
                'title' => 'unit_show',
            ],
            [
                'id'    => 46,
                'title' => 'unit_delete',
            ],
            [
                'id'    => 47,
                'title' => 'unit_access',
            ],
            [
                'id'    => 48,
                'title' => 'maintainer_create',
            ],
            [
                'id'    => 49,
                'title' => 'maintainer_edit',
            ],
            [
                'id'    => 50,
                'title' => 'maintainer_show',
            ],
            [
                'id'    => 51,
                'title' => 'maintainer_delete',
            ],
            [
                'id'    => 52,
                'title' => 'maintainer_access',
            ],
            [
                'id'    => 53,
                'title' => 'accounting_access',
            ],
            [
                'id'    => 54,
                'title' => 'expense_type_create',
            ],
            [
                'id'    => 55,
                'title' => 'expense_type_edit',
            ],
            [
                'id'    => 56,
                'title' => 'expense_type_show',
            ],
            [
                'id'    => 57,
                'title' => 'expense_type_delete',
            ],
            [
                'id'    => 58,
                'title' => 'expense_type_access',
            ],
            [
                'id'    => 59,
                'title' => 'expense_create',
            ],
            [
                'id'    => 60,
                'title' => 'expense_edit',
            ],
            [
                'id'    => 61,
                'title' => 'expense_show',
            ],
            [
                'id'    => 62,
                'title' => 'expense_delete',
            ],
            [
                'id'    => 63,
                'title' => 'expense_access',
            ],
            [
                'id'    => 64,
                'title' => 'documents_menu_access',
            ],
            [
                'id'    => 65,
                'title' => 'document_type_create',
            ],
            [
                'id'    => 66,
                'title' => 'document_type_edit',
            ],
            [
                'id'    => 67,
                'title' => 'document_type_show',
            ],
            [
                'id'    => 68,
                'title' => 'document_type_delete',
            ],
            [
                'id'    => 69,
                'title' => 'document_type_access',
            ],
            [
                'id'    => 70,
                'title' => 'document_create',
            ],
            [
                'id'    => 71,
                'title' => 'document_edit',
            ],
            [
                'id'    => 72,
                'title' => 'document_show',
            ],
            [
                'id'    => 73,
                'title' => 'document_delete',
            ],
            [
                'id'    => 74,
                'title' => 'document_access',
            ],
            [
                'id'    => 75,
                'title' => 'invoice_type_create',
            ],
            [
                'id'    => 76,
                'title' => 'invoice_type_edit',
            ],
            [
                'id'    => 77,
                'title' => 'invoice_type_show',
            ],
            [
                'id'    => 78,
                'title' => 'invoice_type_delete',
            ],
            [
                'id'    => 79,
                'title' => 'invoice_type_access',
            ],
            [
                'id'    => 80,
                'title' => 'invoice_create',
            ],
            [
                'id'    => 81,
                'title' => 'invoice_edit',
            ],
            [
                'id'    => 82,
                'title' => 'invoice_show',
            ],
            [
                'id'    => 83,
                'title' => 'invoice_delete',
            ],
            [
                'id'    => 84,
                'title' => 'invoice_access',
            ],
            [
                'id'    => 85,
                'title' => 'setting_access',
            ],
            [
                'id'    => 86,
                'title' => 'income_type_create',
            ],
            [
                'id'    => 87,
                'title' => 'income_type_edit',
            ],
            [
                'id'    => 88,
                'title' => 'income_type_show',
            ],
            [
                'id'    => 89,
                'title' => 'income_type_delete',
            ],
            [
                'id'    => 90,
                'title' => 'income_type_access',
            ],
            [
                'id'    => 91,
                'title' => 'income_create',
            ],
            [
                'id'    => 92,
                'title' => 'income_edit',
            ],
            [
                'id'    => 93,
                'title' => 'income_show',
            ],
            [
                'id'    => 94,
                'title' => 'income_delete',
            ],
            [
                'id'    => 95,
                'title' => 'income_access',
            ],
            [
                'id'    => 96,
                'title' => 'application_create',
            ],
            [
                'id'    => 97,
                'title' => 'application_edit',
            ],
            [
                'id'    => 98,
                'title' => 'application_show',
            ],
            [
                'id'    => 99,
                'title' => 'application_delete',
            ],
            [
                'id'    => 100,
                'title' => 'application_access',
            ],
            [
                'id'    => 101,
                'title' => 'invoice_recurring_create',
            ],
            [
                'id'    => 102,
                'title' => 'invoice_recurring_edit',
            ],
            [
                'id'    => 103,
                'title' => 'invoice_recurring_show',
            ],
            [
                'id'    => 104,
                'title' => 'invoice_recurring_delete',
            ],
            [
                'id'    => 105,
                'title' => 'invoice_recurring_access',
            ],
            [
                'id'    => 106,
                'title' => 'application_setting_create',
            ],
            [
                'id'    => 107,
                'title' => 'application_setting_edit',
            ],
            [
                'id'    => 108,
                'title' => 'application_setting_show',
            ],
            [
                'id'    => 109,
                'title' => 'application_setting_delete',
            ],
            [
                'id'    => 110,
                'title' => 'application_setting_access',
            ],
            [
                'id'    => 111,
                'title' => 'frontend_setting_access',
            ],
            [
                'id'    => 112,
                'title' => 'hero_section_create',
            ],
            [
                'id'    => 113,
                'title' => 'hero_section_edit',
            ],
            [
                'id'    => 114,
                'title' => 'hero_section_show',
            ],
            [
                'id'    => 115,
                'title' => 'hero_section_delete',
            ],
            [
                'id'    => 116,
                'title' => 'hero_section_access',
            ],
            [
                'id'    => 117,
                'title' => 'features_section_create',
            ],
            [
                'id'    => 118,
                'title' => 'features_section_edit',
            ],
            [
                'id'    => 119,
                'title' => 'features_section_show',
            ],
            [
                'id'    => 120,
                'title' => 'features_section_delete',
            ],
            [
                'id'    => 121,
                'title' => 'features_section_access',
            ],
            [
                'id'    => 122,
                'title' => 'equipment_create',
            ],
            [
                'id'    => 123,
                'title' => 'equipment_edit',
            ],
            [
                'id'    => 124,
                'title' => 'equipment_show',
            ],
            [
                'id'    => 125,
                'title' => 'equipment_delete',
            ],
            [
                'id'    => 126,
                'title' => 'equipment_access',
            ],
            [
                'id'    => 127,
                'title' => 'equipment_type_create',
            ],
            [
                'id'    => 128,
                'title' => 'equipment_type_edit',
            ],
            [
                'id'    => 129,
                'title' => 'equipment_type_show',
            ],
            [
                'id'    => 130,
                'title' => 'equipment_type_delete',
            ],
            [
                'id'    => 131,
                'title' => 'equipment_type_access',
            ],
            [
                'id'    => 132,
                'title' => 'faq_management_access',
            ],
            [
                'id'    => 133,
                'title' => 'faq_category_create',
            ],
            [
                'id'    => 134,
                'title' => 'faq_category_edit',
            ],
            [
                'id'    => 135,
                'title' => 'faq_category_show',
            ],
            [
                'id'    => 136,
                'title' => 'faq_category_delete',
            ],
            [
                'id'    => 137,
                'title' => 'faq_category_access',
            ],
            [
                'id'    => 138,
                'title' => 'faq_question_create',
            ],
            [
                'id'    => 139,
                'title' => 'faq_question_edit',
            ],
            [
                'id'    => 140,
                'title' => 'faq_question_show',
            ],
            [
                'id'    => 141,
                'title' => 'faq_question_delete',
            ],
            [
                'id'    => 142,
                'title' => 'faq_question_access',
            ],
            [
                'id'    => 143,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
