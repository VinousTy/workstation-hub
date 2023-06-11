import React from "react";
import { Route, Routes } from "react-router-dom";
import Login from "../views/pages/admin/auth/Login";

const AdminRoute = () => {
  return (
    <Routes>
      {/* 認証ページ */}
      <Route path="/admin/login" element={<Login />} />
    </Routes>
  );
};

export default AdminRoute;
