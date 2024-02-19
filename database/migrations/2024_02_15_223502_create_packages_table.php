<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('package_code');
            $table->string('package_name');
            $table->string('institution_name');
            $table->string('work_unit');
            $table->integer('budget_year');
            $table->text('work_location')->nullable();
            $table->integer('work_volume');
            $table->text('work_description');
            $table->text('work_specifications');
            $table->boolean('domestic_products');
            $table->boolean('small_business');
            $table->boolean('spp_economic_aspect');
            $table->boolean('spp_social_aspect');
            $table->boolean('spp_environmental_aspect');
            $table->boolean('pre_dipa_dpa');
            $table->integer('total_budget');
            $table->string('procurement_type');
            $table->string('procurement_method');
            $table->date('utilization_start');
            $table->date('utilization_end');
            $table->date('contract_start');
            $table->date('contract_end');
            $table->date('provider_selection_start');
            $table->date('provider_selection_end');
            $table->timestamp('package_update_date')->nullable();
            $table->foreignId('organization_id');
            $table->foreignId('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
