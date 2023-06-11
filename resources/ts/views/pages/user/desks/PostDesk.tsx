import React, { useCallback, useState } from "react";
import { categoryNameSelect } from "../../../../utils/enums/category/categoryName";
import AddInputForm from "../../../components/form/AddInputForm";
import { inputPlaceholder } from "../../../../utils/lang";
import TextArea from "../../../components/form/TextArea";
import { changeFile } from "../../../../utils/functional/image/changeFile";
import { AppDispatch } from "../../../../features/store";
import { useDispatch } from "react-redux";
import {
  registDesk,
  selectDeskMessage,
} from "../../../../features/user/desk/deskSlice";
import { getExtension } from "../../../../utils/functional/image/image";
import { imageType } from "../../../../utils/enums/image/imageType";
import { useNavigate } from "react-router-dom";
import SessionMessage from "../../../components/message/SessionMessage";
import { MessageClass, SessionType } from "../../../../utils/messageType";
import { useSelector } from "react-redux";

const postDesk = () => {
  const dispatch: AppDispatch = useDispatch();
  const [selectedFiles, setSelectedFiles] = useState<File[]>([]);
  const [extensions, setExtensions] = useState<string[]>([]);
  const [previewImages, setPreviewImages] = useState<string[]>([]);
  const [selectedCategory, setSelectedCategory] = useState("");
  const [newCategories, setNewCategories] = useState<string[]>([]);
  const [newCategoryName, setNewCategoryName] = useState("");
  const [categories, setCategories] = useState<string[]>([]);
  const [description, setDescription] = useState("");
  const [addCategoryErrorMessage, setAddCategoryErrorMessage] = useState("");
  const message = useSelector(selectDeskMessage);
  const [errors, setErrors] = useState({
    files: [],
    extensions: [],
    category_name: [],
  });

  const navigate = useNavigate();

  const handleFileChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    // nullでないことを担保
    const files = e.target.files && e.target.files;

    setExtensions(getExtension(files));

    if (files) {
      // 通常の配列に変換
      const filesArray = Array.from(files);
      setSelectedFiles(filesArray);

      /**
       * ファイルの読み込みは時間がかかるので、非同期処理とする
       * NOTE:画像の読み込みが完了したらプレビューを表示
       *      すべての画像の読み込みが完了したら処理を継続するなどの操作が可能になる
       */
      changeFile(filesArray, setPreviewImages);
    }
  };

  const handleDragOver = (e: React.DragEvent<HTMLDivElement>) => {
    // ブラウザ特有のファイルを開くなどのデフォルト動作をキャンセルさせる
    e.preventDefault();
  };

  const handleDrop = (e: React.DragEvent<HTMLDivElement>) => {
    e.preventDefault();
    const files = e.dataTransfer.files;

    setExtensions(getExtension(files));

    if (files) {
      const filesArray = Array.from(files);
      setSelectedFiles(filesArray);

      /**
       * ファイルの読み込みは時間がかかるので、非同期処理とする
       * NOTE:画像の読み込みが完了したらプレビューを表示
       *      すべての画像の読み込みが完了したら処理を継続するなどの操作が可能になる
       */
      changeFile(filesArray, setPreviewImages);
    }
  };

  const handleCategoryChange = (category: string) => {
    if (newCategories.length === 0) {
      if (categories[0] === category) {
        commonChangeCategory(category);
      } else {
        setCategories([category]);
        setSelectedCategory(category);
      }
    } else {
      if (categories.includes(category)) {
        commonChangeCategory(category);
      } else {
        setCategories((prevCategories) => [...prevCategories, category]);
        setSelectedCategory(category);
      }

      if (selectedCategory !== category) {
        commonChangeCategory(selectedCategory);
      }
    }
  };

  const handleNewCategoryChange = (category: string) => {
    if (categories.includes(category)) {
      commonChangeCategory(category);
    } else {
      setCategories((prevCategories) => [...prevCategories, category]);
    }
  };

  const commonChangeCategory = (category: string) => {
    setCategories((prevCategories) =>
      prevCategories.filter((prevCategory) => prevCategory !== category)
    );
  };

  const changeNewTagName = useCallback(
    (e: React.ChangeEvent<HTMLInputElement>) => {
      setNewCategoryName(e.target.value);
    },
    [setNewCategoryName]
  );

  const addNewTag = useCallback(
    (newCategory: string) => {
      const foundCategory = categoryNameSelect.find(
        (categoryName) => categoryName.value === newCategory
      );
      if (newCategory === "") {
        setAddCategoryErrorMessage("カテゴリが入力されていません。");
        return;
      }

      if (foundCategory) {
        setAddCategoryErrorMessage("入力されたカテゴリは既に存在します。");
      } else {
        setNewCategories((prevCategories) => [...prevCategories, newCategory]);
        setCategories((prevCategories) => [...prevCategories, newCategory]);
        setNewCategoryName("");
        setAddCategoryErrorMessage("");
      }
    },
    [setCategories]
  );

  const handleDescriptionChange = useCallback(
    (e: React.ChangeEvent<HTMLTextAreaElement>) => {
      setDescription(e.target.value);
    },
    [setDescription]
  );

  const handlePostClick = async () => {
    const postData = {
      files: selectedFiles,
      extensions: extensions,
      type: imageType.DESK,
      categories: categories,
      description: description,
    };

    await dispatch(registDesk(postData))
      .unwrap()
      .then((res) => {
        navigate("/mypage");
      })
      .catch((error) => {
        setErrors(error);
      });
  };

  return (
    <div className="bg-application-all min-h-screen">
      <div className="max-w-5xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        {message !== "" && message !== undefined && (
          <div className="absolute left-1/2 transform -translate-x-1/2 -translate-y-1/2">
            <SessionMessage
              message={message}
              type={SessionType.danger}
              class={MessageClass.desk}
            />
          </div>
        )}
        <h1 className="text-2xl font-semibold text-gray-300 mb-8">
          デスク投稿
        </h1>
        <div className="mb-8" onDragOver={handleDragOver} onDrop={handleDrop}>
          <label
            className="block mb-2 font-medium text-gray-300"
            htmlFor="fileUpload"
          >
            ファイルアップロード
          </label>
          {previewImages.length > 0 ? (
            <div className="flex flex-wrap -mx-2 mb-2">
              {previewImages.map((previewImage, index) => (
                <img
                  key={index}
                  src={previewImage}
                  alt="Preview"
                  className="h-32 w-auto object-contain mx-2 mb-2"
                />
              ))}
            </div>
          ) : (
            <div className="border border-gray-300 rounded p-4">
              <label
                htmlFor="fileUpload"
                className="flex items-center justify-center h-32 cursor-pointer text-gray-500 hover:bg-gray-100"
              >
                <span className="text-lg">
                  ファイルを選択またはドラッグ＆ドロップ
                </span>
              </label>
            </div>
          )}
          <input
            type="file"
            id="fileUpload"
            accept="image/*"
            onChange={handleFileChange}
            className="hidden"
            multiple
          />
        </div>
        {errors.files && (
          <p className="text-red-500 text-sm font-bold">{errors?.files[0]}</p>
        )}
        <div className="mb-8">
          <label
            className="block mb-2 font-medium text-gray-300"
            htmlFor="tags"
          >
            カテゴリ選択
          </label>
          <div className="flex flex-wrap -mx-1 mb-4">
            {categoryNameSelect.map((category) => (
              <span
                key={category.id}
                className={`inline-block text-sm rounded-full px-3 py-1 my-1 mx-1 cursor-pointer ${
                  categories.includes(category.value)
                    ? "bg-green-800 text-white"
                    : "bg-gray-200 text-gray-800"
                }`}
                onClick={() => handleCategoryChange(category.value)}
              >
                {category.label}
              </span>
            ))}
          </div>
          {errors.category_name && (
            <p className="text-red-500 text-sm font-bold">
              {errors?.category_name[0]}
            </p>
          )}
          <AddInputForm
            label="新規カテゴリを追加"
            value={newCategoryName}
            type="text"
            onChange={changeNewTagName}
            onClick={() => addNewTag(newCategoryName)}
            placeHolderText={inputPlaceholder.category}
          />
          {addCategoryErrorMessage !== "" && (
            <p className="text-red-500 text-sm font-bold">
              {addCategoryErrorMessage}
            </p>
          )}
          <div className="flex flex-wrap -mx-1">
            {newCategories &&
              newCategories.map((category, index) => (
                <span
                  key={index}
                  className={`inline-block text-sm rounded-full px-3 py-1 my-1 mx-1 cursor-pointer ${
                    categories.includes(category)
                      ? "bg-green-800 text-white"
                      : "bg-gray-200 text-gray-800"
                  }`}
                  onClick={() => handleNewCategoryChange(category)}
                >
                  {category}
                </span>
              ))}
          </div>
        </div>
        <TextArea
          label="投稿の説明"
          value={description}
          type="description"
          row={3}
          onChange={handleDescriptionChange}
          placeHolderText={inputPlaceholder.description}
        />
        <div className="text-center mt-8">
          <button
            type="button"
            className="bg-green-800 hover:bg-green-700 text-white font-medium py-2 px-4 rounded"
            onClick={handlePostClick}
          >
            投稿する
          </button>
        </div>
      </div>
    </div>
  );
};

export default postDesk;
