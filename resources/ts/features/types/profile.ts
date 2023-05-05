export interface UPDATE_PROFILE_IMAGE_DATA {
  id: string;
  extension: string;
  hashFileName: string;
}

export interface UPDATE_PROFILE_DATA {
  id: string;
  filePath: string;
  height: number;
  weight: number;
  account: string;
  introduction: string;
}
