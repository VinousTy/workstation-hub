import { UPLOAD_FILE_TYPE } from "../enums/image/imageType";

export interface GENERATE_PRESIGNED_IMAGE_DATA {
  id: string;
  extension: string[];
  type: UPLOAD_FILE_TYPE;
}

export interface UPLOAD_FILE {
  preSignedUrl: string[];
  files: FileList;
}
