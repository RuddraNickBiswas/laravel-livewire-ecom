<?php

use App\Enums\Setting\Font;
use App\Enums\Setting\PrimaryColor;
use App\Enums\Setting\RecordsPerPage;
use App\Enums\Setting\TableSortDirection;
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
        Schema::create('appearances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('panel_id');
            $table->string('primary_color')->default(PrimaryColor::DEFAULT);
            $table->string('bg_color')->default(PrimaryColor::Gray);
            $table->string('font')->default(Font::DEFAULT);
            $table->string('table_sort_direction')->default(TableSortDirection::DEFAULT);
            $table->unsignedTinyInteger('records_per_page')->default(RecordsPerPage::DEFAULT);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appearances');
    }
};
