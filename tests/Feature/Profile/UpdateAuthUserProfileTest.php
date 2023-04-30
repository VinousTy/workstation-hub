<?php

declare(strict_types=1);

namespace Tests\Feature\Profile;

use App\Enums\Profile\ProfileHeight;
use App\Enums\Profile\ProfileWeight;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\TestResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Uid\Ulid;
use Tests\Feature\Traits\Profile\ProfileTrait;
use Tests\TestCase;

class UpdateAuthUserProfileTest extends TestCase
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
     * @group test_success_update_profile
     *
     * @return void
     */
    public function test_success_update_profile(): void
    {
        $successUserData = $this->userProfileData[0];
        $profile = $successUserData->profile;

        $requestData = $this->requestedData(
          'test',
          ProfileHeight::SHORT_STATURE()->getValue(),
          ProfileWeight::LIGHT_WEIGHT()->getValue(),
          'https://test',
          '自己紹介',
        );

        $response = $this->commonExecution(
          $successUserData,
          $profile->id,
          $requestData,
        );

        $this->assertDatabaseHas('profiles', $requestData);

        $response->assertStatus(Response::HTTP_OK)
          ->assertJsonFragment($requestData);
    }

    /**
     * 例外系
     *
     * @group test_update_profile_model_not_found
     *
     * @return void
     */
    public function test_update_profile_model_not_found(): void
    {
        $exceptionUserData = $this->userProfileData[1];
        $profile = $exceptionUserData->profile;

        // プロフィールIDを取得
        $beforeProfileId = $profile->id;

        // プロフィールIDを更新
        $profile->id = Ulid::generate();
        $profile->save();

        $response = $this->commonExecution(
          $exceptionUserData,
          $beforeProfileId,
          $this->requestedData(),
        );

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    /**
     * リクエストデータ
     *
     * @param  string|null  $filePath
     * @param  int|null  $height
     * @param  int|null  $weight
     * @param  string|null  $account
     * @param  string|null  $introduction
     * @return array
     */
    public function requestedData(
      string $filePath = null,
      int $height = null,
      int $weight = null,
      string $account = null,
      string $introduction = null,
    ): array {
        return [
            'file_path' => $filePath,
            'height' => $height,
            'weight' => $weight,
            'account' => $account,
            'introduction' => $introduction,
        ];
    }

    /**
     * テスト共通処理
     *
     * @param  User  $user
     * @return TestResponse
     */
    private function commonExecution(User $user, string $profileId, array $requestData): TestResponse
    {
      return $this->actingAs($user, $this->guard)
        ->put(route('api.profile.update', [
            'profile_id' => $profileId,
        ]
      ), $requestData);
    }
}
