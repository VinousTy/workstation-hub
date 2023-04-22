<?php

declare(strict_types=1);

namespace Tests\Feature\Profile;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\TestResponse;
use Symfony\Component\HttpFoundation\Response;
use Tests\Feature\Traits\Profile\ProfileTrait;
use Tests\TestCase;

class GetAuthUserProfileTest extends TestCase
{
    use RefreshDatabase, WithFaker, ProfileTrait;

    /**
     * @var string
     */
    private string $guard = 'web';

    /**
     * @var Collection
     */
    private Collection $users;

    /**
     * @var Collection
     */
    private Collection $userProfileData;

    public function setUp(): void
    {
      parent::setUp();

      $this->users = User::factory()->count(2)->create();
      $this->userProfileData = $this->setupUseProfileData($this->users);
    }

    /**
     * 正常系
     *
     * @return void
     */
    public function test_get_profile_by_id(): void
    {
        $user = $this->userProfileData[0];
        $profile = $user->profile;

        $response = $this->commonExecution($user);

        $response->assertStatus(Response::HTTP_OK)
          ->assertExactJson($this->getExpectedJsonData($profile));
    }

    /**
     * 期待するデータ
     *
     * @param  Profile  $profile
     * @return array
     */
    private function getExpectedJsonData(Profile $profile): array
    {
        return [
            'id' => $profile->id,
            'user_id' => $profile->user_id,
            'file_path' => $profile->file_path,
            'height' => $profile->height,
            'weight' => $profile->weight,
            'account' => $profile->account,
            'introduction' => $profile->introduction,
        ];
    }

    /**
     * テスト共通処理
     *
     * @param  User  $user
     * @return TestResponse
     */
    private function commonExecution(User $user): TestResponse
    {
      return $this->actingAs($user, $this->guard)
        ->get(route('api.profile.index'));
    }
}
