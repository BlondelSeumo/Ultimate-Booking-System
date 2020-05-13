<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Report
        Permission::findOrCreate('report_view');

        // Contact Submissions
        Permission::findOrCreate('contact_manage');

        //Newsletter
        Permission::findOrCreate('newsletter_manage');

        // Language
        Permission::findOrCreate('language_manage');
        Permission::findOrCreate('language_translation');


        // Booking
        Permission::findOrCreate('booking_view');
        Permission::findOrCreate('booking_update');
        Permission::findOrCreate('booking_manage_others');


        // Templates
        Permission::findOrCreate('template_view');
        Permission::findOrCreate('template_create');
        Permission::findOrCreate('template_update');
        Permission::findOrCreate('template_delete');


        // News
        Permission::findOrCreate('news_view');
        Permission::findOrCreate('news_create');
        Permission::findOrCreate('news_update');
        Permission::findOrCreate('news_delete');
        Permission::findOrCreate('news_manage_others');

        // Roles
        Permission::findOrCreate('role_view');
        Permission::findOrCreate('role_create');
        Permission::findOrCreate('role_update');
        Permission::findOrCreate('role_delete');

        Permission::findOrCreate('permission_view');
        Permission::findOrCreate('permission_create');
        Permission::findOrCreate('permission_update');
        Permission::findOrCreate('permission_delete');

        // Dashboard
        Permission::findOrCreate('dashboard_access');
        Permission::findOrCreate('dashboard_vendor_access');

        // Settings
        Permission::findOrCreate('setting_update');


        // Menus
        Permission::findOrCreate('menu_view');
        Permission::findOrCreate('menu_create');
        Permission::findOrCreate('menu_update');
        Permission::findOrCreate('menu_delete');


        // create permissions
        Permission::findOrCreate('user_view');
        Permission::findOrCreate('user_create');
        Permission::findOrCreate('user_update');
        Permission::findOrCreate('user_delete');

        Permission::findOrCreate('page_view');
        Permission::findOrCreate('page_create');
        Permission::findOrCreate('page_update');
        Permission::findOrCreate('page_delete');
        Permission::findOrCreate('page_manage_others');

        Permission::findOrCreate('setting_view');
        Permission::findOrCreate('setting_update');

        // Media
        Permission::findOrCreate('media_upload');
        Permission::findOrCreate('media_manage');

        // Tour
        Permission::findOrCreate('tour_view');
        Permission::findOrCreate('tour_create');
        Permission::findOrCreate('tour_update');
        Permission::findOrCreate('tour_delete');
        Permission::findOrCreate('tour_manage_others');
        Permission::findOrCreate('tour_manage_attributes');

        // Location
        Permission::findOrCreate('location_view');
        Permission::findOrCreate('location_create');
        Permission::findOrCreate('location_update');
        Permission::findOrCreate('location_delete');
        Permission::findOrCreate('location_manage_others');

        //Review
        Permission::findOrCreate('review_manage_others');

        // Other System Permissions

        Permission::findOrCreate('system_log_view');

        // create roles and assign created permissions

        // this can be done as separate statements
        $this->initVendor();

        // this can be done as separate statements
        $customer = Role::findOrCreate('customer');

        $role = Role::findOrCreate('administrator');

        $role->givePermissionTo(Permission::all());


    }

    public function initVendor(){

        $vendor = Role::findOrCreate('vendor');

        $vendor->givePermissionTo('media_upload');
        $vendor->givePermissionTo('tour_view');
        $vendor->givePermissionTo('tour_create');
        $vendor->givePermissionTo('tour_update');
        $vendor->givePermissionTo('tour_delete');
        $vendor->givePermissionTo('dashboard_vendor_access');
    }
}
