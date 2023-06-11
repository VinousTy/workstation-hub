import { createAsyncThunk, createSlice, PayloadAction } from "@reduxjs/toolkit";
import { RootState } from "../../store";
import axios from "axios";
import { DESK_INITIALSTATE, POST_DESK_DATA } from "../types/desk";
import { StatusCode } from "../../../utils/statusCode";

const initialState: DESK_INITIALSTATE = {
  data: [
    {
      desk: {
        id: "",
        description: null,
      },
      user: {
        id: "",
        name: "",
      },
      profile: {
        id: "",
        file_path: undefined,
      },
      categories: [
        {
          id: "",
          name: "",
        },
      ],
      images: [],
    },
  ],
  message: "",
  errors: [] as unknown,
};

export const getDeskList = createAsyncThunk(
  "desk/get",
  async (_, { rejectWithValue }) => {
    try {
      const res = await axios.get("/api/desk");
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

export const registDesk = createAsyncThunk(
  "desk/post",
  async (postData: POST_DESK_DATA, { rejectWithValue }) => {
    try {
      const formData = new FormData();
      postData.files.forEach((file, index) => {
        formData.append("files[]", file);
        formData.append("extensions[]", postData.extensions[index]);
      });
      postData.categories.forEach((category) => {
        formData.append("category_name[]", category);
      });
      formData.append("type", postData.type);
      formData.append("description", postData.description);

      const res = await axios.post("/api/desk", formData, {
        headers: {
          "Content-Type": "multipart/form-data",
        },
      });
      return res.data;
    } catch (error) {
      if (
        axios.isAxiosError(error) &&
        error.response?.status === StatusCode.VALIDATION
      ) {
        return rejectWithValue(error.response.data.errors);
      } else if (
        axios.isAxiosError(error) &&
        error.response?.status === StatusCode.SERVER_ERROR
      ) {
        return rejectWithValue(error.response.data);
      }
      return rejectWithValue("サーバーに接続できません");
    }
  }
);

export const deskSlice = createSlice({
  name: "desk",
  initialState,
  reducers: {
    closeDeskMessage(state) {
      state.message = "";
    },
  },
  extraReducers: (builder) => {
    builder.addCase(getDeskList.fulfilled, (state, action) => {
      state.data = action.payload;
    });
    builder.addCase(registDesk.fulfilled, (state, action) => {
      state.message = action.payload.message;
    });
    builder.addCase(registDesk.rejected, (state, action: any) => {
      state.errors = action.payload;
      state.message = action.payload.message;
    });
  },
});

export const { closeDeskMessage } = deskSlice.actions;

export const selectDeskList = (state: RootState) => state.desk.data;
export const selectDeskMessage = (state: RootState) => state.desk.message;

export default deskSlice.reducer;
