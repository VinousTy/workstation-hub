export interface GENERATE_PRESIGNED_IMAGE_DATA {
  id: string;
  extension: string;
}

export interface UPLOAD_FILE {
  preSignedUrl: string;
  file: File;
}
