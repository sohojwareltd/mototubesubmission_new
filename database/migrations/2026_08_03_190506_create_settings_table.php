<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('group')->nullable();
            $table->timestamps();
        });

        $now = now();

        DB::table('settings')->insert(
            collect(config('site'))
                ->map(fn ($value, $key) => [
                    'key' => "site.{$key}",
                    'value' => $value,
                    'group' => 'site',
                    'created_at' => $now,
                    'updated_at' => $now,
                ])
                ->values()
                ->all()
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
