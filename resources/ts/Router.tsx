import React from "react";
import { BrowserRouter, Route, Routes } from "react-router-dom";
import Header from "./views/components/header/Header";
import Login from "./views/pages/auth/Login";
import Register from "./views/pages/auth/Register";

const Router = () => {
  return (
    <BrowserRouter>
      <Header />
      <Routes>
        <Route path="/login" element={<Login />} />
        <Route path="/register" element={<Register />} />
      </Routes>
    </BrowserRouter>
  );
};

export default Router;
