export type UPLOAD_FILE_TYPE = (typeof imageType)[keyof typeof imageType];

export const imageType = {
  PROFILE: "profile",
  DESK: "desk",
} as const;
