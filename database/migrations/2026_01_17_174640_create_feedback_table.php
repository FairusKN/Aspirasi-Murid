<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enum\FeedbackStatus;
use App\Enum\Category;
use App\Enum\Location;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->foreignUuid('user_id')->constrained('users');
            $table->foreignUuid('category_id')->constrained('categories');
            $table->string('feedback_title');
            $table->text('details');
            $table->enum('location', array_column(Location::cases(), 'value'));
            $table->string('location_details')->nullable();
            $table->enum('status', array_column(FeedbackStatus::cases(), 'value'))->default(FeedbackStatus::Waiting->value);
            $table->string('image')->nullable();
            $table->text('admin_response')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};
