export type USER_TYPE = (typeof UserType)[keyof typeof UserType];

export const UserType = {
  admin: 1,
  user: 2,
} as const;
