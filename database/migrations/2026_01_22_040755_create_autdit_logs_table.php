<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enum\LogAction;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('autdit_logs', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->foreignUuid('admin_id')->constrained('users')->cascadeOnDelete();
            $table->enum("action", array_column(LogAction::cases(), 'value'));
            $table->string("admin_ip");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('autdit_logs');
    }
};
