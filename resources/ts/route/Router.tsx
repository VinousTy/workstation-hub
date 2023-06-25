import React from "react";
import { BrowserRouter, Route, Routes } from "react-router-dom";
import UserHeader from "../views/components/header/user/Header";
import TopPage from "../views/pages/user/top/TopPage";
import Login from "../views/pages/user/auth/Login";
import Register from "../views/pages/user/auth/Register";
import VerifyEmail from "../views/pages/user/auth/VerifyEmail";
import VerifyEmailComplate from "../views/pages/user/auth/VerifyEmailComplate";
import ForgotPassword from "../views/pages/user/auth/ForgotPassword";
import ForgotPasswordCompalate from "../views/pages/user/auth/ForgotPasswordCompalate";
import ResetPassword from "../views/pages/user/auth/ResetPassword";
import ResetPasswordComplate from "../views/pages/user/auth/ResetPasswordCompalate";
import UserAccountSetting from "../views/pages/user/settings/UserAccountSetting";
import UserNameSettings from "../views/pages/user/settings/UserNameSettings";
import EmailSettings from "../views/pages/user/settings/EmailSettings";
import PasswordSettings from "../views/pages/user/settings/PasswordSettings";
import ProfileSettings from "../views/pages/user/settings/ProfileSettings";
import PostDesk from "../views/pages/user/desks/PostDesk";
import AdminLogin from "../views/pages/admin/auth/Login";
import AdminHeader from "../views/components/header/admin/AdminHeader";
import IndexPage from "../views/pages/admin/notification/IndexPage";

const Router = () => {
  return (
    <BrowserRouter>
      <Routes>
        {/* 一般ユーザー向けルート */}
        <Route
          path="/*"
          element={
            <>
              <UserHeader />
              <Routes>
                {/* トップページ */}
                <Route path="/" element={<TopPage />} />
                {/* 認証ページ */}
                <Route path="/login" element={<Login />} />
                <Route path="/register" element={<Register />} />
                <Route path="/verify/email" element={<VerifyEmail />} />
                <Route
                  path="/email/authorization/complete"
                  element={<VerifyEmailComplate />}
                />
                <Route path="/forgot/password" element={<ForgotPassword />} />
                <Route
                  path="/forgot/password/compalate"
                  element={<ForgotPasswordCompalate />}
                />
                <Route path="/api/reset-password" element={<ResetPassword />} />
                <Route
                  path="/reset-password/compalate"
                  element={<ResetPasswordComplate />}
                />
                {/* 投稿ページ */}
                <Route path="/post" element={<PostDesk />} />
                {/* 設定ページ */}
                <Route
                  path="/settings/account"
                  element={<UserAccountSetting />}
                />
                <Route path="/settings/name" element={<UserNameSettings />} />
                <Route path="/settings/email" element={<EmailSettings />} />
                <Route
                  path="/settings/password"
                  element={<PasswordSettings />}
                />
                <Route path="/settings/profile" element={<ProfileSettings />} />
              </Routes>
            </>
          }
        />

        {/* 管理者向けルート */}
        <Route
          path="/admin/*"
          element={
            <>
              <AdminHeader />
              <Routes>
                {/* 認証ページ */}
                <Route path="/login" element={<AdminLogin />} />
                {/* お知らせページ */}
                <Route path="/notification" element={<IndexPage />} />
              </Routes>
            </>
          }
        />
      </Routes>
    </BrowserRouter>
  );
};

export default Router;
