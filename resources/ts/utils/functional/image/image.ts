import axios from "axios";
import { StatusCode } from "../../statusCode";
import {
  GENERATE_PRESIGNED_IMAGE_DATA,
  UPLOAD_FILE,
} from "../../types/ImageType";

// 拡張子取得
export const getExtension = (file: File | null): string => {
  const fileNameArray = file?.name.split(".");

  if (!fileNameArray || fileNameArray.length <= 1) {
    return "";
  }

  return fileNameArray.pop() ?? "";
};

// 署名付きURLを発行
export const fetchGeneratePreSignedUrl = async (
  imageData: GENERATE_PRESIGNED_IMAGE_DATA
) => {
  try {
    const res = await axios.post(
      `/api/profile/${imageData.id}/presigned-url/`,
      {
        extension: imageData.extension,
        type: imageData.type,
      },
      {
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json",
        },
      }
    );
    return res.data;
  } catch (error) {
    if (
      axios.isAxiosError(error) &&
      error.response?.status === StatusCode.VALIDATION
    ) {
      return error.response.data.errors;
    } else if (
      axios.isAxiosError(error) &&
      error.response?.status === StatusCode.NOT_FOUND
    ) {
      return error.response.data.message;
    }
    return "サーバーに接続できません";
  }
};

// S3へアップロード
export const uploadFileToS3 = async (uploadFile: UPLOAD_FILE) => {
  try {
    const res = await axios.put(uploadFile.preSignedUrl, uploadFile.file, {
      headers: {
        "Content-Type": uploadFile.file.type,
      },
    });
    return res.data;
  } catch (error) {
    if (
      axios.isAxiosError(error) &&
      error.response?.status === StatusCode.VALIDATION
    ) {
      return error.response.data.errors;
    } else if (
      axios.isAxiosError(error) &&
      error.response?.status === StatusCode.NOT_FOUND
    ) {
      return error.response.data.message;
    }
    return "サーバーに接続できません";
  }
};
