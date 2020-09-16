<?php

use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'group_user',
            function (Blueprint $table) {
                $table->unsignedInteger('user_id');
                $table->unsignedInteger('group_id');

                $table->primary(['user_id', 'group_id']);

                $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->cascadeOnDelete()
                    ->cascadeOnUpdate();

                $table->foreign('group_id')
                    ->references('id')
                    ->on('groups')
                    ->cascadeOnDelete()
                    ->cascadeOnUpdate();
            }
        );

        $userId = User::where('name', '=', 'Admin')
            ->first()
            ->id;

        $groupId = Group::where('name', '=', 'Админ')
            ->first()
            ->id;

        DB::table('group_user')
            ->insert(['user_id' => $userId, 'group_id' => $groupId]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_user');
    }
}
