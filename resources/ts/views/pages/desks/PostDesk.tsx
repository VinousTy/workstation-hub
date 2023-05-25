import React, { useCallback, useState } from "react";
import { categoryNameSelect } from "../../../utils/enums/category/categoryName";
import AddInputForm from "../../components/form/AddInputForm";
import { inputPlaceholder } from "../../../utils/lang";
import TextArea from "../../components/form/TextArea";
import { changeFile } from "../../../utils/functional/image/changeFile";
import { AppDispatch } from "../../../features/store";
import { useDispatch } from "react-redux";
import { registDesk } from "../../../features/desk/deskSlice";

const postDesk = () => {
  const dispatch: AppDispatch = useDispatch();
  const [selectedFile, setSelectedFile] = useState<File | null>(null);
  const [previewImage, setPreviewImage] = useState<string | null>(null);
  const [selectedCategory, setSelectedCategory] = useState("");
  const [newCategories, setNewCategories] = useState<string[]>([]);
  const [newCategoryName, setNewCategoryName] = useState("");
  const [categories, setCategories] = useState<string[]>([]);
  const [description, setDescription] = useState("");
  const [addCategoryErrorMessage, setAddCategoryErrorMessage] = useState("");
  const [errors, setErrors] = useState({
    category_name: [],
  });

  const handleFileChange = (event: React.ChangeEvent<HTMLInputElement>) => {
    // nullでないことを担保
    const file = event.target.files && event.target.files[0];
    setSelectedFile(file || null);

    changeFile(file, setPreviewImage);
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

  const handleDragOver = (e: React.DragEvent<HTMLDivElement>) => {
    // ブラウザ特有のファイルを開くなどのデフォルト動作をキャンセルさせる
    e.preventDefault();
  };

  const handleDrop = (e: React.DragEvent<HTMLDivElement>) => {
    e.preventDefault();
    // nullでないことを担保
    const file = e.dataTransfer.files && e.dataTransfer.files[0];
    setSelectedFile(file || null);

    changeFile(file, setPreviewImage);
  };

  const handlePostClick = async () => {
    const postData = {
      category: categories,
      description: description,
    };

    await dispatch(registDesk(postData))
      .unwrap()
      .then((res) => {})
      .catch((error) => {
        setErrors(error);
      });
  };

  return (
    <div className="bg-application-all min-h-screen">
      <div className="max-w-5xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
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
          {previewImage ? (
            <img
              src={previewImage}
              alt="Preview"
              className="max-h-64 w-full object-contain"
            />
          ) : (
            <div className="border border-gray-300 rounded">
              <label
                htmlFor="fileUpload"
                className="flex items-center justify-center h-32 p-4 cursor-pointer text-gray-500 hover:bg-gray-100"
              >
                <span className="text-lg">
                  ファイルを選択またはドラッグ＆ドロップ
                </span>
              </label>
              <input
                type="file"
                id="fileUpload"
                accept="image/*"
                onChange={handleFileChange}
                className="hidden"
              />
            </div>
          )}
        </div>
        <div className="mb-8">
          <label
            className="block mb-2 font-medium text-gray-300"
            htmlFor="tags"
          >
            カテゴリ選択
          </label>
          <div className="mt-2 mb-8">
            {categoryNameSelect.map((category) => (
              <span
                key={category.id}
                className={`inline-block text-sm rounded-full px-3 py-1 my-1 mr-2 cursor-pointer ${
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
          <div>
            {newCategories &&
              newCategories.map((category, index) => (
                <span
                  key={index}
                  className={`inline-block text-sm rounded-full px-3 py-1 my-1 mr-2 cursor-pointer ${
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
