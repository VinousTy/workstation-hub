import { Action, configureStore, ThunkAction } from "@reduxjs/toolkit";
import {
  persistReducer,
  FLUSH,
  REHYDRATE,
  PAUSE,
  PERSIST,
  PURGE,
  REGISTER,
} from "redux-persist";
import storage from "redux-persist/lib/storage/session";
import authReducer from "./user/auth/authSlice";
import profileReducer from "./user/profile/profileSlice";
import deskReducer from "./user/desk/deskSlice";
import commonReducer from "./common/commonSlice";
import adminAuthReducer from "./admin/auth/authSlice";
import adminNotificationReducer from "./admin/notification/notificationSlice";

// redux-presistの設定
export const persistConfig = {
  key: "auth", // 保存するkey名
  storage, // 使用するストレージ
};

export const presistProfileConfig = {
  key: "profile",
  storage,
};

export const persistAdminAuthConfig = {
  key: "admin_auth", // 保存するkey名
  storage, // 使用するストレージ
};

// 永続化するためのreducer作成
const persistedReducer = persistReducer(persistConfig, authReducer);
const presistedProfileReducer = persistReducer(
  presistProfileConfig,
  profileReducer
);
const presistedAdminAuthReducer = persistReducer(
  persistAdminAuthConfig,
  adminAuthReducer
);

export const store = configureStore({
  reducer: {
    // user
    auth: persistedReducer,
    profile: presistedProfileReducer,
    desk: deskReducer,
    // admin
    adminAuth: presistedAdminAuthReducer,
    adminNotification: adminNotificationReducer,
    // common
    common: commonReducer,
  },
  middleware: (getDefaultMiddleware) =>
    getDefaultMiddleware({
      serializableCheck: {
        ignoredActions: [FLUSH, REHYDRATE, PAUSE, PERSIST, PURGE, REGISTER],
      },
    }),
});

export type AppDispatch = typeof store.dispatch;
export type RootState = ReturnType<typeof store.getState>;
export type AppThunk<ReturnType = void> = ThunkAction<
  ReturnType,
  RootState,
  unknown,
  Action<string>
>;
