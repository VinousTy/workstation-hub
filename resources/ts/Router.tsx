import React from "react";
import { BrowserRouter, Route, Routes } from "react-router-dom";
import Header from "./views/components/header/Header";
import Login from "./views/pages/auth/Login";
import Register from "./views/pages/auth/Register";
import VerifyEmail from "./views/pages/auth/VerifyEmail";
import VerifyEmailComplate from "./views/pages/auth/VerifyEmailComplate";
import ForgotPassword from "./views/pages/auth/ForgotPassword";
import ForgotPasswordCompalate from "./views/pages/auth/ForgotPasswordCompalate";
import ResetPassword from "./views/pages/auth/ResetPassword";
import ResetPasswordComplate from "./views/pages/auth/ResetPasswordCompalate";
import UserAccountSetting from "./views/pages/settings/UserAccountSetting";
import EmailSettings from "./views/pages/settings/EmailSettings";

const Router = () => {
  return (
    <BrowserRouter>
      <Header />
      <Routes>
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
        <Route path="/settings/account" element={<UserAccountSetting />} />
        <Route path="/settings/email" element={<EmailSettings />} />
      </Routes>
    </BrowserRouter>
  );
};

export default Router;
