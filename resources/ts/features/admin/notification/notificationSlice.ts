import { createAsyncThunk, createSlice } from "@reduxjs/toolkit";
import axios from "axios";
import { RootState } from "../../store";
import { StatusCode } from "../../../utils/statusCode";
import { INITIAL_STATE, PAGEDATA } from "../type/notification";
import { convertToCamelCase } from "../../../utils/functional/formatData/formatResponse";
import { NOTIFICATION_LIST_TYPE } from "../../../utils/types/formatResponse";

const initialState: INITIAL_STATE = {
  notification: [
    {
      id: 1,
      title: "",
      body: "",
      publishedAt: "",
      isPublished: 0,
      isSent: 0,
      createdAt: "",
      updatedAt: "",
    },
  ],
  total: 0,
  lastPage: 0,
  currentPage: 0,
  links: [
    {
      url: "",
      label: "",
      active: false,
    },
  ],
  message: "",
  errors: [],
};

export const getNotification = createAsyncThunk(
  "notification/get",
  async (pageData: PAGEDATA, { rejectWithValue }) => {
    try {
      const res = await axios.get(
        `/api/admin/notification/?per_page=${pageData.perPage}&current_page=${pageData.currentPage}`
      );
      const convertedData = convertToCamelCase<NOTIFICATION_LIST_TYPE>(
        res.data
      );

      return convertedData;
    } catch (error) {
      if (axios.isAxiosError(error) && error.response) {
        console.log(error);
        return rejectWithValue(error.response.data);
      }
      return rejectWithValue("サーバーに接続できません");
    }
  }
);

export const adminNotificationSlice = createSlice({
  name: "adminNotification",
  initialState,
  reducers: {},
  extraReducers: (builder) => {
    builder.addCase(getNotification.fulfilled, (state, action) => {
      state.notification = action.payload.data;
      state.total = action.payload.total;
      state.currentPage = action.payload.currentPage;
      state.lastPage = action.payload.lastPage;
      state.links = action.payload.links;
    });
  },
});

export const selectNotification = (state: RootState) => state.adminNotification;
export const selectTotal = (state: RootState) => state.adminNotification.total;
export const selectCurrentPage = (state: RootState) =>
  state.adminNotification.currentPage;
export const selectLastPage = (state: RootState) =>
  state.adminNotification.lastPage;
export const selectLinks = (state: RootState) => state.adminNotification.links;

export default adminNotificationSlice.reducer;
