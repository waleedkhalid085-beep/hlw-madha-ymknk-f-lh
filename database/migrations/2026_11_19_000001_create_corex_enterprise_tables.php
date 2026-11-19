<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Oilfields
        Schema::create('oilfields', function (Blueprint ) {
            ->id();
            ->string('name_en');
            ->string('name_ar');
            ->string('code')->unique(); // RUM, ZUB, MAJ, WQ1
            ->string('location_coordinates')->nullable();
            ->timestamps();
        });

        // 2. Wells Register
        Schema::create('wells', function (Blueprint ) {
            ->id();
            ->foreignId('oilfield_id')->constrained('oilfields')->onDelete('cascade');
            ->string('well_number')->unique(); // R-542
            ->string('reservoir')->nullable(); // Mishrif, Zubair
            ->decimal('total_depth_meters', 8, 2)->default(3200);
            ->string('tree_manufacturer')->default('Cameron');
            ->string('tree_rating_psi')->default('5000 PSI');
            ->decimal('tubing_pressure_psi', 8, 2)->default(3400);
            ->decimal('casing_pressure_psi', 8, 2)->default(800);
            ->string('status')->default('Active'); // Active, Servicing, Suspended
            ->timestamp('last_integrity_test_at')->nullable();
            ->timestamps();
        });

        // 3. Xmas Tree Valves
        Schema::create('valves', function (Blueprint ) {
            ->id();
            ->foreignId('well_id')->constrained('wells')->onDelete('cascade');
            ->string('valve_type'); // Swab, Upper Master, Lower Master, Kill Wing, Prod Wing, Choke
            ->string('tag_number')->unique();
            ->string('operation_mode')->default('Manual'); // Hydraulic, Manual
            ->string('current_state')->default('Open'); // Open, Closed, Throttled
            ->decimal('operating_pressure_psi', 8, 2)->default(3400);
            ->date('last_lubricated_at')->nullable();
            ->string('integrity_status')->default('Passed');
            ->timestamps();
        });

        // 4. Warehouse & Inventory Items
        Schema::create('inventory_items', function (Blueprint ) {
            ->id();
            ->string('item_code')->unique();
            ->string('name_en');
            ->string('name_ar');
            ->string('category'); // Valves, Lubricants, Packings, Tools
            ->integer('stock_quantity')->default(0);
            ->integer('reorder_level')->default(10);
            ->decimal('unit_cost_usd', 10, 2);
            ->string('warehouse_location')->default('Basra Central WH');
            ->timestamps();
        });

        // 5. Material Requests & Vouchers
        Schema::create('material_requests', function (Blueprint ) {
            ->id();
            ->string('voucher_number')->unique(); // MR-2026-9021
            ->enum('voucher_type', ['issue', 'receipt', 'transfer']);
            ->foreignId('well_id')->nullable()->constrained('wells');
            ->foreignId('item_id')->constrained('inventory_items');
            ->integer('quantity');
            ->string('requested_by');
            ->string('approved_by')->nullable();
            ->string('status')->default('Pending'); // Pending, Approved, Dispatched
            ->timestamps();
        });

        // 6. Workforce & Training Records
        Schema::create('employees', function (Blueprint ) {
            ->id();
            ->string('badge_number')->unique();
            ->string('name_en');
            ->string('name_ar');
            ->string('job_title');
            ->string('department')->default('Wellhead Services');
            ->string('dosimeter_id')->nullable();
            ->decimal('latest_radiation_msv', 6, 3)->default(0.05);
            ->timestamps();
        });

        Schema::create('training_records', function (Blueprint ) {
            ->id();
            ->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
            ->string('course_name'); // IWCF, H2S, Radiation NORM
            ->string('certificate_number')->unique();
            ->date('issue_date');
            ->date('expiry_date');
            ->string('status')->default('Valid'); // Valid, Expiring, Expired
            ->timestamps();
        });

        // 7. Permits to Work (PTW)
        Schema::create('permit_to_works', function (Blueprint ) {
            ->id();
            ->string('permit_number')->unique();
            ->enum('permit_type', ['Hot Work', 'Cold Work', 'Confined Space']);
            ->foreignId('well_id')->constrained('wells');
            ->text('work_description');
            ->string('performing_authority');
            ->dateTime('valid_from');
            ->dateTime('valid_until');
            ->string('status')->default('Active');
            ->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('permit_to_works');
        Schema::dropIfExists('training_records');
        Schema::dropIfExists('employees');
        Schema::dropIfExists('material_requests');
        Schema::dropIfExists('inventory_items');
        Schema::dropIfExists('valves');
        Schema::dropIfExists('wells');
        Schema::dropIfExists('oilfields');
    }
};
