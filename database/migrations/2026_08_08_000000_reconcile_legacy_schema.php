<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('appointments')) {
            Schema::create('appointments', function (Blueprint $table) {
                $table->increments('id');
                $table->boolean('appointment_status')->default(false);
                $table->unsignedSmallInteger('order_number')->nullable();
            });
        }

        if (! Schema::hasTable('appointments_has_lang')) {
            Schema::create('appointments_has_lang', function (Blueprint $table) {
                $table->unsignedInteger('appointment_id');
                $table->integer('lang_id');
                $table->string('appointment_name');
                $table->primary(['appointment_id', 'lang_id']);
            });
        }

        if (! Schema::hasTable('orders')) {
            Schema::create('orders', function (Blueprint $table) {
                $table->id();
                $table->string('email');
                $table->string('first_name');
                $table->string('last_name');
                $table->string('phone');
                $table->string('p_first_name')->nullable();
                $table->string('p_last_name')->nullable();
                $table->string('p_phone')->nullable();
                $table->string('city')->nullable();
                $table->string('address');
                $table->string('home')->nullable();
                $table->string('entrance')->nullable();
                $table->string('floor')->nullable();
                $table->string('intercom')->nullable();
                $table->text('comment')->nullable();
                $table->longText('products');
                $table->string('status')->default('Pending');
                $table->text('error')->nullable();
                $table->unsignedInteger('total_count')->default(0);
                $table->decimal('total_price', 12, 2)->default(0);
                $table->string('payment_id')->nullable();
                $table->unsignedTinyInteger('type')->nullable();
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('ad_block')) {
            Schema::create('ad_block', function (Blueprint $table) {
                $table->id();
                $table->string('ad_block_name');
                $table->longText('ad_block_code')->nullable();
                $table->boolean('is_hidden')->default(false);
            });
        }

        if (! Schema::hasTable('quick_search')) {
            Schema::create('quick_search', function (Blueprint $table) {
                $table->id();
                $table->boolean('is_hidden')->default(false);
            });
        }

        if (! Schema::hasTable('quick_search_lang')) {
            Schema::create('quick_search_lang', function (Blueprint $table) {
                $table->unsignedBigInteger('quick_search_id');
                $table->integer('lang_id');
                $table->string('quick_search_name');
                $table->string('quick_search_alias');
                $table->primary(['quick_search_id', 'lang_id']);
            });
        }

        if (! Schema::hasTable('contact_request')) {
            Schema::create('contact_request', function (Blueprint $table) {
                $table->id();
                $table->string('contact_person');
                $table->string('email')->nullable();
                $table->string('phone')->nullable();
                $table->text('request_text')->nullable();
                $table->timestamp('receive_date')->nullable();
                $table->boolean('is_processed')->default(false);
            });
        }

        if (! Schema::hasTable('apply_request')) {
            Schema::create('apply_request', function (Blueprint $table) {
                $table->id();
                $table->string('resource_name');
                $table->string('resource_url')->nullable();
                $table->integer('category_id')->nullable();
                $table->text('resource_desc')->nullable();
                $table->string('contact_person');
                $table->string('email')->nullable();
                $table->string('phone')->nullable();
                $table->timestamp('receive_date')->nullable();
                $table->boolean('is_processed')->default(false);
            });
        }

        if (Schema::hasTable('categories') && ! Schema::hasColumn('categories', 'icon')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->string('icon')->nullable();
            });
        }

        if (Schema::hasTable('products')) {
            $missingAppointmentId = ! Schema::hasColumn('products', 'appointment_id');
            $missingProductCount = ! Schema::hasColumn('products', 'product_count');

            if ($missingAppointmentId || $missingProductCount) {
                Schema::table('products', function (Blueprint $table) use ($missingAppointmentId, $missingProductCount) {
                    if ($missingAppointmentId) {
                        $table->unsignedInteger('appointment_id')->nullable();
                    }

                    if ($missingProductCount) {
                        $table->unsignedInteger('product_count')->default(0);
                    }
                });
            }
        }
    }

    public function down(): void
    {
        // This migration safely reconciles databases created from the legacy SQL dump.
    }
};
