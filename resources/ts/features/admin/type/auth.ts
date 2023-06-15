export interface ADMIN_INITIALSTATE {
  isLogin: boolean;
  admin: {
    id: string;
    name: string;
    email: string;
    createdAt: string;
    updatedAt: string;
  };
  message: string;
  errors: [];
}

export interface LOGIN_DATA {
  email: string;
  password: string;
}
