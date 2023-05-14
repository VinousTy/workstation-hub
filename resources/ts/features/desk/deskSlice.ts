import { createAsyncThunk, createSlice, PayloadAction } from "@reduxjs/toolkit";
import { RootState } from "../store";
import axios from "axios";
import { DESK_INITIALSTATE } from "../types/desk";

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

export const deskSlice = createSlice({
  name: "desk",
  initialState,
  reducers: {},
  extraReducers: (builder) => {
    builder.addCase(getDeskList.fulfilled, (state, action) => {
      state.data = action.payload;
    });
  },
});

export const selectDeskList = (state: RootState) => state.desk.data;

export default deskSlice.reducer;
