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

class GetDeskList extends TestCase
{
    use RefreshDatabase, WithFaker, DeskTrait;

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
    private Collection $dummyData;

    /**
     * @var int
     */
    private int $createDeskDataCount = 5;

    public function setUp(): void
    {
        parent::setUp();

        $this->users = User::factory()->count(1)->create();
        $this->dummyData = $this->setupUseDeskData($this->users, $this->createDeskDataCount);
    }

    /**
     * @group test_get_desk_list_count
     *
     * @return void
     */
    public function test_get_desk_list_count(): void
    {
        $user = $this->dummyData[0];

        /**
         * リレーション先データを取得する際には下記のようにする
         * NOTE: あくまで参考程度なので要編集
         */
        // $desks = $user->desks;
        // $deskImages = [];
        // foreach($desks as $desk) {
        //   Log::debug($desk->deskImages);
        // }
        // Log::debug($deskImages);

        $response = $this->commonExecution($user);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonCount($this->createDeskDataCount);
    }

    /**
     * アクセス先エンドポイントを指定
     *
     * @param  User  $user
     * @return TestResponse
     */
    private function commonExecution(User $user): TestResponse
    {
      return $this->actingAs($user, $this->guard)
        ->get(route('api.desk.index'));
    }
}
