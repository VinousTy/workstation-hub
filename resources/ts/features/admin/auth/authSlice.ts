import { createAsyncThunk, createSlice } from "@reduxjs/toolkit";
import axios from "axios";
import { RootState } from "../../store";
import { StatusCode } from "../../../utils/statusCode";
import { ADMIN_INITIALSTATE, LOGIN_DATA } from "../type/auth";

const initialState: ADMIN_INITIALSTATE = {
  isLogin: false,
  admin: {
    id: "",
    name: "",
    email: "",
    createdAt: "",
    updatedAt: "",
  },
  message: "",
  errors: [],
};

export const adminLogin = createAsyncThunk(
  "admin/login",
  async (loginData: LOGIN_DATA, { rejectWithValue }) => {
    try {
      const res = await axios.post(
        "/api/admin/login",
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

export const adminLogout = createAsyncThunk(
  "admin/logout",
  async (_, { rejectWithValue }) => {
    try {
      const res = await axios.post("/api/admin/logout", {
        headers: {
          "Content-Type": "application/json",
        },
      });
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

export const adminAuthSlice = createSlice({
  name: "adminAuth",
  initialState,
  reducers: {
    closeAdminMessage(state) {
      state.message = "";
    },
  },
  extraReducers: (builder) => {
    builder.addCase(adminLogin.fulfilled, (state, action) => {
      state.isLogin = true;
      state.admin = action.payload.admin;
      state.message = action.payload.message;
    });
    builder.addCase(adminLogin.rejected, (state, action: any) => {
      state.errors = action.payload;
    });
    builder.addCase(adminLogout.fulfilled, (state, action) => {
      state.isLogin = false;
      state.message = action.payload.message;
    });
  },
});

export const { closeAdminMessage } = adminAuthSlice.actions;

export const selectIsLoggedIn = (state: RootState) => state.adminAuth.isLogin;
export const selectadmin = (state: RootState) => state.adminAuth.admin;
export const selectEmail = (state: RootState) => state.adminAuth.admin.email;
export const selectMessage = (state: RootState) => state.adminAuth.message;
export const selectErrors = (state: RootState) => state.adminAuth.errors;

export default adminAuthSlice.reducer;
