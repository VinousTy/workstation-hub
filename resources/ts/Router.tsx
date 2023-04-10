import React from "react";
import { BrowserRouter, Route, Routes } from "react-router-dom";
import Header from "./views/components/header/Header";
import Login from "./views/pages/auth/Login";
import Register from "./views/pages/auth/Register";
import VerifyEmail from "./views/pages/auth/VerifyEmail";
import VerifyEmailComplate from "./views/pages/auth/VerifyEmailComplate";
import ForgotPassword from "./views/pages/auth/ForgotPassword";
import ForgotPasswordCompalate from "./views/pages/auth/ForgotPasswordCompalate";

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
      </Routes>
    </BrowserRouter>
  );
};

export default Router;
