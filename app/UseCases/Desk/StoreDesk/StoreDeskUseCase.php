<?php

declare(strict_types=1);

namespace App\UseCases\Desk\StoreDesk;

use App\Domain\ValueObjects\Desk\DeskDescription;
use App\Domain\ValueObjects\User\UserId;
use App\Exceptions\Desk\StoreDeskException;
use App\Models\Desk;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Desk\DeskRepository;
use App\Repositories\DeskCategory\DeskCategoryRepository;
use App\Repositories\Image\ImageRepository;
use App\Repositories\Image\S3Repository;
use App\Repositories\User\Auth\AuthUserRepository;
use App\Traits\GeneratePreSignedUrl\MakeS3FilePath;
use App\UseCases\Desk\Inputs\StoreDeskInput;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use PDOException;

class StoreDeskUseCase implements StoreDeskUseCaseInterface
{
    use MakeS3FilePath;

    private const DISK_NAME = 's3_private';

    private const S3_PATH = 'image';

    /**
     * @param  AuthUserRepository  $authUserRepository
     * @param  DeskRepository  $deskRepository
     * @param  CategoryRepository  $categoryReposity
     * @param  DeskCategoryRepository  $deskCategoryReposity
     * @param  ImageRepository  $imageRepository
     */
    public function __construct(
      private readonly AuthUserRepository $authUserRepository,
      private readonly DeskRepository $deskRepository,
      private readonly CategoryRepository $categoryReposity,
      private readonly DeskCategoryRepository $deskCategoryReposity,
      private readonly ImageRepository $imageRepository,
      private readonly S3Repository $s3Repository,
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function execute(StoreDeskInput $input): void
    {
        $user = $this->authUserRepository->getUser();
        $files = $input->getFiles();
        $extensions = $input->getExtensions();

        $hashFileNames = [];

        foreach ($extensions as $extension) {
          $hashFileNames[] = $this->getHashFileName($extension);
        }

        Log::info('投稿を登録します', [
            'method' => __METHOD__,
            'user_id' => $user->id,
        ]);

        try {
          $desk = DB::transaction(function () use ($user, $input, $files, $extensions, $hashFileNames) {
              $desk = $this->deskRepository->storeDesk(
                UserId::create($user->id),
                DeskDescription::create($input->getDescription()
              ));

              $category = $this->categoryReposity->firstOrCreate($input->getCategoryNames());

              $this->deskCategoryReposity->storeDeskCategory(
                new Desk([
                    'id' => $desk->getId()->getValue(),
                    'user_id' => $desk->getUserId()->getValue(),
                    'description' => $desk->getDescription()->getValue(),
                ]),
                $category->getId()
              );

              foreach ($hashFileNames as $key => $hashFileName) {
                $filePath = $this->makeS3FilePath(self::S3_PATH, $desk->getId()->getValue(), $input->getType(), $hashFileName);

                $this->imageRepository->uploadDeskImageFile(
                  deskId: $desk->getId()->getValue(),
                  fileName: (string) $files[$key]->getClientOriginalName(),
                  extension: $extensions[$key],
                  filePath: $filePath
                );

                $this->s3Repository->uplloadS3(self::DISK_NAME, $filePath, $files[$key]);
              }

             return $desk;
          });

          Log::info('投稿の登録が完了しました', [
              'method' => __METHOD__,
              'user_id' => $user->id,
              'desk_id' => $desk->getId()->getValue(),
          ]);
        } catch (PDOException $e) {
          Log::error(__('exception.desk.failed'), [
              'method' => __METHOD__,
              'exception_message' => $e->getMessage(),
              'exception_file' => $e->getFile(),
              'line' => $e->getLine(),
              'trace' => $e->getTrace(),
          ]);

          throw new StoreDeskException(__('message.error.desk.store'));
        }
    }

    /**
     * ハッシュ化したファイル名を作成
     *
     * @param  string  $extensition
     * @return string
     */
    private function getHashFileName(string $extensition): string
    {
        return Str::random(40).'.'.$extensition;
    }
}
