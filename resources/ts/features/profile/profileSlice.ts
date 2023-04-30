import { createAsyncThunk, createSlice } from "@reduxjs/toolkit";
import axios from "axios";
import { RootState } from "../store";

const initialState = {
  profile: {
    id: "",
    userId: "",
    filePath: "",
    height: 0,
    weight: 0,
    account: "",
    introduction: "",
  },
  message: "",
  errors: [],
};

export const getProfile = createAsyncThunk(
  "profile/get",
  async (_, { rejectWithValue }) => {
    try {
      const res = await axios.get("/api/profile");
      return res.data;
    } catch (error) {
      if (axios.isAxiosError(error) && error.response) {
        console.log(error);
        return rejectWithValue(error.response.data);
      }
      return rejectWithValue("サーバーに接続できません");
    }
  }
);

export const profileSlice = createSlice({
  name: "profile",
  initialState,
  reducers: {},
  extraReducers: (builder) => {
    builder.addCase(getProfile.fulfilled, (state, action) => {
      state.profile = action.payload;
    });
  },
});

export const selectProfile = (state: RootState) => state.profile;
export const selectMessage = (state: RootState) => state.profile.message;
export const selectErrors = (state: RootState) => state.profile.errors;

export default profileSlice.reducer;
