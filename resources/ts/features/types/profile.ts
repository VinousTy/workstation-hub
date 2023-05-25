import { UPLOAD_FILE_TYPE } from "../../utils/enums/image/imageType";

export interface UPDATE_PROFILE_IMAGE_DATA {
  id: string;
  extension: string;
  hashFileName: string;
  type: UPLOAD_FILE_TYPE
}

export interface UPDATE_PROFILE_DATA {
  id: string;
  filePath: string;
  height: number;
  weight: number;
  account: string;
  introduction: string;
}
