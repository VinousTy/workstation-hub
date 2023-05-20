<?php

declare(strict_types=1);

namespace Tests\Feature\Desk;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\TestResponse;
use Symfony\Component\HttpFoundation\Response;
use Tests\Feature\Traits\Desk\DeskTrait;
use Tests\TestCase;

class StoreDeskTest extends TestCase
{
    use WithFaker, RefreshDatabase, DeskTrait;

    private string $guard = 'web';

    /**
     * @var Collection
     */
    private Collection $users;

    /**
     * @var Collection
     */
    private Collection $dummyData;

    public function setUp(): void
    {
        parent::setUp();

        $this->users = User::factory()->count(2)->create();
        $this->dummyData = $this->setupUseDeskData($this->users);
    }

    /**
     * @group test_success_create_desk
     *
     * @return void
     */
    public function test_success_create_desk(): void
    {
        $user = $this->dummyData[0];

        $desks = $user->desks;
        $categoryName = '';

        foreach ($desks as $desk) {
            $categoryName = $desk->categories[0]->name;
        }

        $requestedData = $this->createdRequestData(
            userId: $user->id,
            description: 'test',
            categoryName: $categoryName,
        );

        $response = $this->commonExecution($user, $requestedData);

        $this->assertDatabaseHas('desks', [
            'user_id' => $user->id,
            'description' => $requestedData['description'],
        ]);

        $response->assertStatus(Response::HTTP_NO_CONTENT);
    }

    /**
     * @group test_for_new_categories
     *
     * @return void
     */
    public function test_for_new_categories(): void
    {
        $user = $this->dummyData[1];

        $desks = $user->desks;

        $requestedData = $this->createdRequestData(
            userId: $user->id,
            description: 'test',
            categoryName: 'newCategory',
        );

        $response = $this->commonExecution($user, $requestedData);

        $this->assertDatabaseHas('categories', [
            'name' => $requestedData['category_name'],
        ]);

        $response->assertStatus(Response::HTTP_NO_CONTENT);
    }

    /**
     * リクエスト時に送信するデータ生成
     *
     * @param  string  $userId
     * @param  string|null  $description
     * @param  string  $categoryName
     * @return array
     */
    private function createdRequestData(
      string $userId,
      string|null $description,
      string $categoryName
    ): array {
        return [
            'user_id' => $userId,
            'description' => $description,
            'category_name' => $categoryName,
        ];
    }

    /**
     * エンドポイントを指定
     *
     * @param  User  $user
     * @return TestResponse
     */
    private function commonExecution(User $user, array $requestedData): TestResponse
    {
      return $this->actingAs($user, $this->guard)
        ->post(route('api.desk.store'), $requestedData);
    }
}
