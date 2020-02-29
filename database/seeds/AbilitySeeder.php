<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AbilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('permissions')->truncate();
        DB::table('permission_role')->truncate();
        DB::table('permission_user')->truncate();
        Schema::enableForeignKeyConstraints();
        $owner = Role::where('name', 'owner')->first();
        DB::table('permission')->insert([
            [
                'name' => Str::slug('List Role', '-'),
                'display_name' => 'List Role',
                'description' => 'View list role',
                'group' => 'Role'
            ],
            [
                'name' => Str::slug('Add Role', '-'),
                'display_name' => 'Add Role',
                'description' => 'Add new role',
                'group' => 'Role'
            ],
            [
                'name' => Str::slug('Update Role', '-'),
                'display_name' => 'Update Role',
                'description' => 'Update info and permission of role',
                'group' => 'Role'
            ],
            [
                'name' => Str::slug('Destroy Role', '-'),
                'display_name' => 'Destroy Role',
                'description' => 'Delete role',
                'group' => 'Role'
            ],
            [
                'name' => Str::slug('List Ability', '-'),
                'display_name' => 'List Ability',
                'description' => 'View list ability',
                'group' => 'Ability'
            ],
            [
                'name' => Str::slug('List Tag', '-'),
                'display_name' => 'List Tag',
                'description' => 'View list tag',
                'group' => 'PostTag'
            ],
            [
                'name' => Str::slug('Add Tag', '-'),
                'display_name' => 'Add Tag',
                'description' => 'Add new tag',
                'group' => 'PostTag'
            ],
            [
                'name' => Str::slug('Update Tag', '-'),
                'display_name' => 'Update Tag',
                'description' => 'Update info of tag',
                'group' => 'PostTag'
            ],
            [
                'name' => Str::slug('Destroy Tag', '-'),
                'display_name' => 'Destroy Tag',
                'description' => 'Delete tag',
                'group' => 'PostTag'
            ],
            [
                'name' => Str::slug('List Category', '-'),
                'display_name' => 'List Category',
                'description' => 'View list Category',
                'group' => 'PostCategory'
            ],
            [
                'name' => Str::slug('Add Category', '-'),
                'display_name' => 'Add Category',
                'description' => 'Add new Category',
                'group' => 'PostCategory'
            ],
            [
                'name' => Str::slug('Update Category', '-'),
                'display_name' => 'Update Category',
                'description' => 'Update info of Category',
                'group' => 'PostCategory'
            ],
            [
                'name' => Str::slug('Destroy Category', '-'),
                'display_name' => 'Destroy Category',
                'description' => 'Delete Category',
                'group' => 'PostCategory'
            ],
            [
                'name' => Str::slug('List Post', '-'),
                'display_name' => 'List Post',
                'description' => 'View list Post',
                'group' => 'Post'
            ],
            [
                'name' => Str::slug('Add Post', '-'),
                'display_name' => 'Add Post',
                'description' => 'Add new Post',
                'group' => 'Post'
            ],
            [
                'name' => Str::slug('Update Post', '-'),
                'display_name' => 'Update Post',
                'description' => 'Update info of Post',
                'group' => 'Post'
            ],
            [
                'name' => Str::slug('Destroy Post', '-'),
                'display_name' => 'Destroy Post',
                'description' => 'Delete Post',
                'group' => 'Post'
            ],
            [
                'name' => Str::slug('Block Unblock Post', '-'),
                'display_name' => 'Block Unblock Post',
                'description' => 'Block Or Unblock A Post',
                'group' => 'Post'
            ],
            [
                'name' => Str::slug('List User', '-'),
                'display_name' => 'List User',
                'description' => 'View list User',
                'group' => 'User'
            ],
            [
                'name' => Str::slug('Add User', '-'),
                'display_name' => 'Add User',
                'description' => 'Add new User',
                'group' => 'User'
            ],
            [
                'name' => Str::slug('Update User', '-'),
                'display_name' => 'Update User',
                'description' => 'Update info of User',
                'group' => 'User'
            ],
            [
                'name' => Str::slug('Destroy User', '-'),
                'display_name' => 'Destroy User',
                'description' => 'Delete User',
                'group' => 'User'
            ],
            [
                'name' => Str::slug('Block Unblock User', '-'),
                'display_name' => 'Block Unblock User',
                'description' => 'Block Or Unblock A User',
                'group' => 'User'
            ],
        ]);
    }
}
