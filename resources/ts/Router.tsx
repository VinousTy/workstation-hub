import React from "react";
import { BrowserRouter, Route, Routes } from "react-router-dom";
import Header from "./views/components/header/Header";
import Login from "./views/pages/auth/Login";

const Router = () => {
  return (
    <BrowserRouter>
      <Header />
      <Routes>
        <Route path="/login" element={<Login />} />
      </Routes>
    </BrowserRouter>
  );
};

export default Router;
