export interface USER_INITIALSTATE {
  isLogin: boolean;
  user: {
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

export interface REGISTER_DATA {
  email: string;
  password: string;
  passwordConfirmation: string;
}
