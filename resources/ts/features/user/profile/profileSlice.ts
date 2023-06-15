import { createAsyncThunk, createSlice } from "@reduxjs/toolkit";
import axios from "axios";
import { RootState } from "../../store";
import {
  UPDATE_PROFILE_DATA,
  UPDATE_PROFILE_IMAGE_DATA,
} from "../types/profile";
import { StatusCode } from "../../../utils/statusCode";

const initialState = {
  profile: {
    id: "",
    userId: "",
    file_path: "",
    height: 0,
    weight: 0,
    account: "",
    introduction: "",
  },
  message: "",
  errors: [] as unknown,
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

export const updateProfileImage = createAsyncThunk(
  "image/update",
  async (
    updateProfileImageData: UPDATE_PROFILE_IMAGE_DATA,
    { rejectWithValue }
  ) => {
    try {
      const res = await axios.post(
        `/api/profile/${updateProfileImageData.id}/upload/`,
        {
          extension: updateProfileImageData.extension,
          hash_file_name: updateProfileImageData.hashFileName,
          type: updateProfileImageData.type,
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
      if (
        axios.isAxiosError(error) &&
        error.response?.status === StatusCode.VALIDATION
      ) {
        return rejectWithValue(error.response.data.errors);
      } else if (
        axios.isAxiosError(error) &&
        error.response?.status === StatusCode.NOT_FOUND
      ) {
        return rejectWithValue(error.response.data.message);
      }
      return rejectWithValue("サーバーに接続できません");
    }
  }
);

export const updateAuthUserProfile = createAsyncThunk(
  "profile/update",
  async (updateProfileData: UPDATE_PROFILE_DATA, { rejectWithValue }) => {
    try {
      const res = await axios.put(
        `/api/profile/${updateProfileData.id}/update/`,
        {
          file_path: updateProfileData.filePath,
          height: updateProfileData.height,
          weight: updateProfileData.weight,
          account: updateProfileData.account,
          introduction: updateProfileData.introduction,
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
      if (
        axios.isAxiosError(error) &&
        error.response?.status === StatusCode.VALIDATION
      ) {
        return rejectWithValue(error.response.data.errors);
      } else if (
        axios.isAxiosError(error) &&
        error.response?.status === StatusCode.NOT_FOUND
      ) {
        return rejectWithValue(error.response.data.message);
      }
      return rejectWithValue("サーバーに接続できません");
    }
  }
);

export const profileSlice = createSlice({
  name: "profile",
  initialState,
  reducers: {
    closeProfileMessage(state) {
      state.message = "";
    },
  },
  extraReducers: (builder) => {
    builder.addCase(getProfile.fulfilled, (state, action) => {
      state.profile = action.payload;
    });
    builder.addCase(updateProfileImage.fulfilled, (state, action) => {
      state.profile.file_path = action.payload.profile.file_path;
      state.message = action.payload.message;
    });
    builder.addCase(updateProfileImage.rejected, (state, action) => {
      state.errors = action.payload;
    });
    builder.addCase(updateAuthUserProfile.fulfilled, (state, action) => {
      state.profile = action.payload.profile;
      state.message = action.payload.message;
    });
    builder.addCase(updateAuthUserProfile.rejected, (state, action) => {
      state.errors = action.payload;
    });
  },
});

export const { closeProfileMessage } = profileSlice.actions;

export const selectProfile = (state: RootState) => state.profile;
export const selectProfileImage = (state: RootState) =>
  state.profile.profile.file_path;
export const selectMessage = (state: RootState) => state.profile.message;
export const selectErrors = (state: RootState) => state.profile.errors;

export default profileSlice.reducer;
