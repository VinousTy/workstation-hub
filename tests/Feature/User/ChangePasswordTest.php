<?php

declare(strict_types=1);

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\TestResponse;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ChangePasswordTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @var string
     */
    private string $guard = 'web';

    /**
     * @var User
     */
    private User $user;

    public function setUp(): void
    {
       parent::setUp();

       $this->user = User::factory()->create();
    }

    /**
     * @group test_success_change_password
     *
     * @return void
     */
    public function test_success_change_password(): void
    {
        $newPassword = 'test1234';

        $response = $this->commonExecution($this->user, $newPassword);

        $this->assertDatabaseMissing('users', [
            'password' => Hash::make('password'),
        ]);

        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * テスト共通処理
     *
     * @param  User  $user
     * @return TestResponse
     */
    private function commonExecution(User $user, string $newPassword): TestResponse
    {
      return $this->actingAs($user, $this->guard)
        ->putJson(route('api.user.change.password', [
            'password' => $newPassword,
            'password_confirmation' => $newPassword,
        ]));
    }
}
