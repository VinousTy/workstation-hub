/**
 * ファイルの読み込みは時間がかかるので、非同期処理とする
 * NOTE:画像の読み込みが完了したらプレビューを表示
 *      すべての画像の読み込みが完了したら処理を継続するなどの操作が可能になる
 */
export const changeFile = (
  filesArray: File[],
  setPreviewImages: React.Dispatch<React.SetStateAction<string[]>>
) => {
  const readerPromises = filesArray.map((file) => {
    return new Promise<string>((resolve, reject) => {
      const reader = new FileReader();
      reader.onloadend = () => {
        resolve(reader.result as string);
      };
      reader.onerror = reject;
      reader.readAsDataURL(file);
    });
  });

  Promise.all(readerPromises)
    .then((results) => {
      setPreviewImages(results);
    })
    .catch((error) => {
      console.error("Error reading files:", error);
    });
};
