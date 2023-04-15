import { createAsyncThunk, createSlice, PayloadAction } from "@reduxjs/toolkit";
import {
  FORGOT_PASSWORD_DATA,
  LOGIN_DATA,
  REGISTER_DATA,
  RESET_PASSWORD_DATA,
  USER_INITIALSTATE,
} from "../types/auth";
import axios from "axios";
import { RootState } from "../store";
import { StatusCode } from "../../utils/statusCode";

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

export const userLogin = createAsyncThunk(
  "user/login",
  async (loginData: LOGIN_DATA, { rejectWithValue }) => {
    try {
      const res = await axios.post(
        "api/login",
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
      return rejectWithValue("サーバーに接続できません。");
    }
  }
);

export const userRegister = createAsyncThunk(
  "user/register",
  async (registerData: REGISTER_DATA, { rejectWithValue }) => {
    try {
      const res = await axios.post(
        "api/register",
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
      return rejectWithValue("サーバーに接続できません。");
    }
  }
);

export const forgotPassword = createAsyncThunk(
  "forgot/password",
  async (forgotPasswordData: FORGOT_PASSWORD_DATA, { rejectWithValue }) => {
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
      return rejectWithValue("サーバーに接続できません。");
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
      return rejectWithValue("サーバーに接続できません。");
    }
  }
);

export const authSlice = createSlice({
  name: "auth",
  initialState,
  reducers: {},
  extraReducers: (builder) => {
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
  },
});

export const selectIsLoggedIn = (state: RootState) => state.auth.isLogin;
export const selectUser = (state: RootState) => state.auth.user;
export const selectEmail = (state: RootState) => state.auth.user.email;
export const selectSuccessMessage = (state: RootState) => state.auth.message;
export const selectMessage = (state: RootState) => state.auth.errors;

export default authSlice.reducer;
