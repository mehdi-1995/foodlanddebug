<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('courier_id')->nullable()->constrained()->onDelete('set null');
        });
    }

    public function down(): void
    {
        // Use raw SQL to check and drop foreign key if exists
        $foreignKeyName = 'orders_courier_id_foreign';
        $connection = Schema::getConnection();
        $dbName = $connection->getDatabaseName();

        $foreignKeyExists = $connection->selectOne("
            SELECT CONSTRAINT_NAME
            FROM information_schema.KEY_COLUMN_USAGE
            WHERE TABLE_SCHEMA = ? AND TABLE_NAME = 'orders' AND COLUMN_NAME = 'courier_id' AND CONSTRAINT_NAME = ?
        ", [$dbName, $foreignKeyName]);

        Schema::table('orders', function (Blueprint $table) use ($foreignKeyExists, $foreignKeyName) {
            if ($foreignKeyExists) {
                $table->dropForeign($foreignKeyName);
            }
            $table->dropColumn('courier_id');
        });
    }
};
