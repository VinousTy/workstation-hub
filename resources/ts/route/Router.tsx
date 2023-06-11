import React from "react";
import { BrowserRouter } from "react-router-dom";
import Header from "../views/components/header/Header";
import UserRoute from "./UserRoute";
import AdminRoute from "./AdminRoute";

const Router = () => {
  return (
    <BrowserRouter>
      <Header />
      <UserRoute />
      <AdminRoute />
    </BrowserRouter>
  );
};

export default Router;
