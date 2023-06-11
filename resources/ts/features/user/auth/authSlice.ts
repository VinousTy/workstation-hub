import { createAsyncThunk, createSlice, PayloadAction } from "@reduxjs/toolkit";
import {
  LOGIN_DATA,
  POST_EMAIL_DATA,
  POST_PASSWORD_DATA,
  POST_USER_NAME_DATA,
  REGISTER_DATA,
  RESET_PASSWORD_DATA,
  USER_INITIALSTATE,
} from "../types/auth";
import axios from "axios";
import { RootState } from "../../store";
import { StatusCode } from "../../../utils/statusCode";

const initialState: USER_INITIALSTATE = {
  isLogin: false,
  user: {
    id: "",
    name: "",
    email: "",
    createdAt: "",
    updatedAt: "",
  },
  message: "",
  errors: [],
};

export const getAuthUser = createAsyncThunk(
  "user/get",
  async (_, { rejectWithValue }) => {
    try {
      const res = await axios.get("/api/user");
      return res.data;
    } catch (error) {
      // axios例外であるかどうかを判定
      if (axios.isAxiosError(error) && error.response) {
        console.log(error);
        return rejectWithValue("データを取得できませんでした");
      }
      console.log(error);
      return rejectWithValue("サーバーに接続できません");
    }
  }
);

export const userLogin = createAsyncThunk(
  "user/login",
  async (loginData: LOGIN_DATA, { rejectWithValue }) => {
    try {
      const res = await axios.post(
        "/api/login",
        {
          email: loginData.email,
          password: loginData.password,
        },
        {
          headers: {
            "Content-Type": "application/json",
          },
        }
      );
      return res.data;
    } catch (error) {
      // axios例外であるかどうかを判定
      if (axios.isAxiosError(error) && error.response) {
        return rejectWithValue(error.response.data.errors);
      }
      return rejectWithValue("サーバーに接続できません");
    }
  }
);

export const userRegister = createAsyncThunk(
  "user/register",
  async (registerData: REGISTER_DATA, { rejectWithValue }) => {
    try {
      const res = await axios.post(
        "/api/register",
        {
          email: registerData.email,
          password: registerData.password,
          password_confirmation: registerData.passwordConfirmation,
        },
        {
          headers: {
            "Content-Type": "application/json",
          },
        }
      );
      return res.data;
    } catch (error) {
      // axios例外であるかどうかを判定
      if (axios.isAxiosError(error) && error.response) {
        return rejectWithValue(error.response.data.errors);
      }
      return rejectWithValue("サーバーに接続できません");
    }
  }
);

export const forgotPassword = createAsyncThunk(
  "forgot/password",
  async (forgotPasswordData: POST_EMAIL_DATA, { rejectWithValue }) => {
    try {
      const res = await axios.post(
        "/api/forgot-password",
        {
          email: forgotPasswordData.email,
        },
        {
          headers: {
            "Content-Type": "application/json",
          },
        }
      );
      return res.data;
    } catch (error) {
      // axios例外であるかどうかを判定
      if (
        axios.isAxiosError(error) &&
        error.response?.status === StatusCode.VALIDATION
      ) {
        return rejectWithValue(error.response.data.errors);
      } else if (
        axios.isAxiosError(error) &&
        error.response?.status === StatusCode.SERVER_ERROR
      ) {
        return rejectWithValue(error.response.data.message);
      }
      return rejectWithValue("サーバーに接続できません");
    }
  }
);

export const resetPassword = createAsyncThunk(
  "reset/password",
  async (resetPasswordData: RESET_PASSWORD_DATA, { rejectWithValue }) => {
    try {
      const res = await axios.post(
        "/api/reset-password",
        {
          email: resetPasswordData.email,
          password: resetPasswordData.password,
          password_confirmation: resetPasswordData.passwordConfirmation,
          token: resetPasswordData.token,
        },
        {
          headers: {
            "Content-Type": "application/json",
          },
        }
      );
      return res.data;
    } catch (error) {
      // axios例外であるかどうかを判定
      if (
        axios.isAxiosError(error) &&
        error.response?.status === StatusCode.VALIDATION
      ) {
        return rejectWithValue(error.response.data.errors);
      } else if (
        axios.isAxiosError(error) &&
        error.response?.status === StatusCode.SERVER_ERROR
      ) {
        return rejectWithValue(error.response.data.message);
      }
      return rejectWithValue("サーバーに接続できません");
    }
  }
);

export const changeUserName = createAsyncThunk(
  "change/username",
  async (postUserNameData: POST_USER_NAME_DATA, { rejectWithValue }) => {
    try {
      const res = await axios.put(
        "/api/user/change/name",
        {
          name: postUserNameData.name,
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
      // axios例外であるかどうかを判定
      if (
        axios.isAxiosError(error) &&
        error.response?.status === StatusCode.VALIDATION
      ) {
        return rejectWithValue(error.response.data.errors);
      } else if (
        axios.isAxiosError(error) &&
        error.response?.status === StatusCode.SERVER_ERROR
      ) {
        return rejectWithValue(error.response.data.message);
      }
      return rejectWithValue("サーバーに接続できません");
    }
  }
);

export const changeEmail = createAsyncThunk(
  "change/email",
  async (postEmailData: POST_EMAIL_DATA, { rejectWithValue }) => {
    try {
      const res = await axios.put(
        "/api/user/change/email",
        {
          email: postEmailData.email,
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
      // axios例外であるかどうかを判定
      if (
        axios.isAxiosError(error) &&
        error.response?.status === StatusCode.VALIDATION
      ) {
        return rejectWithValue(error.response.data.errors);
      } else if (
        axios.isAxiosError(error) &&
        error.response?.status === StatusCode.SERVER_ERROR
      ) {
        return rejectWithValue(error.response.data.message);
      }
      return rejectWithValue("サーバーに接続できません");
    }
  }
);

export const changePassword = createAsyncThunk(
  "change/password",
  async (postPasswordData: POST_PASSWORD_DATA, { rejectWithValue }) => {
    try {
      const res = await axios.put(
        "/api/user/change/password",
        {
          password: postPasswordData.password,
          password_confirmation: postPasswordData.passwordConfirmation,
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
      // axios例外であるかどうかを判定
      if (
        axios.isAxiosError(error) &&
        error.response?.status === StatusCode.VALIDATION
      ) {
        return rejectWithValue(error.response.data.errors);
      } else if (
        axios.isAxiosError(error) &&
        error.response?.status === StatusCode.SERVER_ERROR
      ) {
        return rejectWithValue(error.response.data.message);
      }
      return rejectWithValue("サーバーに接続できません");
    }
  }
);

export const userLogout = createAsyncThunk(
  "user/logout",
  async (data, { rejectWithValue }) => {
    try {
      const res = await axios.post("/api/logout", {
        headers: {
          "Content-Type": "application/json",
        },
      });
      console.log(res.data);
      return res.data;
    } catch (error) {
      // axios例外であるかどうかを判定
      if (axios.isAxiosError(error) && error.response) {
        console.log(error);
        return rejectWithValue(
          "サーバーでエラーが発生しました。再度お試し下さい"
        );
      }
      return rejectWithValue("サーバーに接続できません");
    }
  }
);

export const authSlice = createSlice({
  name: "auth",
  initialState,
  reducers: {
    closeUserMessage(state) {
      state.message = "";
    },
  },
  extraReducers: (builder) => {
    builder.addCase(getAuthUser.fulfilled, (state, action) => {
      state.user = action.payload.user;
    });
    builder.addCase(userLogin.fulfilled, (state, action) => {
      state.isLogin = true;
      state.user = action.payload.user;
      state.message = action.payload.message;
    });
    builder.addCase(userLogin.rejected, (state, action: any) => {
      state.errors = action.payload;
    });
    builder.addCase(userRegister.fulfilled, (state, action) => {
      state.isLogin = true;
      state.user = action.payload.user;
      state.message = action.payload.message;
    });
    builder.addCase(userRegister.rejected, (state, action: any) => {
      state.errors = action.payload;
    });
    builder.addCase(forgotPassword.fulfilled, (state, action) => {
      state.user = action.payload.user;
    });
    builder.addCase(forgotPassword.rejected, (state, action: any) => {
      state.errors = action.payload;
    });
    builder.addCase(resetPassword.fulfilled, (state, action) => {
      state.message = action.payload.message;
    });
    builder.addCase(resetPassword.rejected, (state, action: any) => {
      state.errors = action.payload;
    });
    builder.addCase(changeUserName.fulfilled, (state, action: any) => {
      state.message = action.payload.message;
    });
    builder.addCase(changeUserName.rejected, (state, action: any) => {
      state.errors = action.payload;
    });
    builder.addCase(changeEmail.fulfilled, (state, action: any) => {
      state.message = action.payload.message;
    });
    builder.addCase(changeEmail.rejected, (state, action: any) => {
      state.errors = action.payload;
    });
    builder.addCase(changePassword.fulfilled, (state, action: any) => {
      state.message = action.payload.message;
    });
    builder.addCase(changePassword.rejected, (state, action: any) => {
      state.errors = action.payload;
    });
    builder.addCase(userLogout.fulfilled, (state, action) => {
      state.isLogin = false;
      state.message = action.payload.message;
    });
  },
});

export const { closeUserMessage } = authSlice.actions;

export const selectIsLoggedIn = (state: RootState) => state.auth.isLogin;
export const selectUser = (state: RootState) => state.auth.user;
export const selectEmail = (state: RootState) => state.auth.user.email;
export const selectMessage = (state: RootState) => state.auth.message;
export const selectErrors = (state: RootState) => state.auth.errors;

export default authSlice.reducer;
