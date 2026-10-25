<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{

    use RefreshDatabase;

    //ユーザーがデータベースに保存されることをテスト
    public function test_user_can_be_created()
    {
        // ユーザーを作成
        $user = User::factory()->create([
            'name' => 'テストユーザー',
            'email' => 'test@example.com'
        ]);      

        // データベースにユーザーが存在することを確認
        $this->assertDatabaseHas('users', [
        'email' => 'test@example.com'
    
        ]);
    }
    // メールアドレスの重複チェックをテスト
    public function test_email_must_be_unique()
    {
        // 1. 例外の事前宣言 🛡️（記述済み）
        $this->expectException(\Illuminate\Database\QueryException::class);

        // 2. 1人目のユーザーを作成 👤 
        User::factory()->create([
            'email' => 'test@example.com'
        ]);

        // 3. 同じメールアドレスで2人目を作成しようとする 👤💥
         User::factory()->create([
            'email' => 'test@example.com'
        ]);
        
        
    }


}   
