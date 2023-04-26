<?php

declare(strict_types=1);

namespace Tests\Feature\User;

use App\Models\EmailUpdate;
use App\Models\User;
use App\Notifications\VerifyUpdateEmailNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Notification;
use Illuminate\Testing\TestResponse;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ChangeEmailTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private string $guard = 'web';

    /**
     * @var User
     */
    private User $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'email' => 'test@mail.com',
        ]);
    }

    /**
     * @group test_success_change_email
     *
     * @return void
     */
    public function test_success_change_email()
    {
        // 通知をモック化
        // モック化しているので、実際にはメールは飛ばない
        Notification::fake();

        // この段階では通知が飛んでいないことを確認
        Notification::assertNothingSent();

        $newEmail = 'new-test@mail.com';

        $emailUpdate = EmailUpdate::create([
            'user_id' => $this->user->id,
            'new_email' => $newEmail,
            'token' => 'test',
            'requested_at' => Date::now(),
        ]);

        $response = $this->commonExecution($this->user, $newEmail);

        $this->assertDatabaseHas('email_updates', [
            'user_id' => $this->user->id,
            'new_email' => $newEmail,
        ]);

        Notification::assertSentTo(
          $emailUpdate,
          VerifyUpdateEmailNotification::class,
        );

        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * テスト共通処理
     *
     * @param  User  $user
     * @param  string  $newEmail
     * @return TestResponse
     */
    public function commonExecution(User $user, string $newEmail): TestResponse
    {
        return $this->actingAs($user, $this->guard)
          ->put(route('api.user.change.email', [
              'email' => $newEmail,
          ]));
    }
}
