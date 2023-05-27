import axios from "axios";
import { StatusCode } from "../../statusCode";
import {
  GENERATE_PRESIGNED_IMAGE_DATA,
  UPLOAD_FILE,
} from "../../types/ImageType";

type GeneratePreSignedUrlResponse = {
  hash_file_name: string[];
  pre_signed_url: string[];
}

// 拡張子取得
export const getExtension = (files: FileList | null): string[] => {
  if (!files) {
    return [];
  }

  const extensions = Array.from(files).map((file) => {
    const fileNameArray = file.name.split(".");
    if (fileNameArray.length <= 1) {
      return "";
    }
    return fileNameArray.pop() || "";
  });

  return extensions;
};

// 署名付きURLを発行
export const fetchGeneratePreSignedUrl = async (
  imageData: GENERATE_PRESIGNED_IMAGE_DATA
): Promise<GeneratePreSignedUrlResponse> => {
  try {
    const res = await axios.post(
      `/api/image/${imageData.id}/presigned-url/`,
      {
        extensions: imageData.extension,
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
    throw new Error("サーバーに接続できません");
  }
};

// S3へアップロード
export const uploadFileToS3 = async (uploadFile: UPLOAD_FILE) => {
  try {
    const preSignedUrls = uploadFile.preSignedUrl;

    const formDataArray = Array.from(uploadFile.files).map((file, index) => {
      return {
        file: file,
        preSignedUrl: preSignedUrls[index],
      };
    });

    const res = await formDataArray.map(({ file, preSignedUrl }) => {
      return axios.put(preSignedUrl, file, {
        headers: {
          "Content-Type": file.type,
        },
      });
    });
    return (await res[0]).data;
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
