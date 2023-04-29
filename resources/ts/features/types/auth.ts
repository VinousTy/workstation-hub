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

export interface POST_EMAIL_DATA {
  email: string;
}

export interface POST_PASSWORD_DATA {
  password: string;
  passwordConfirmation: string;
}

export interface RESET_PASSWORD_DATA {
  email: string | null;
  password: string;
  passwordConfirmation: string;
  token: string | null;
}
