import React from "react";
import { BrowserRouter } from "react-router-dom";
import Header from "./views/components/header/Header";

const Router = () => {
  return (
    <BrowserRouter>
      <Header />
    </BrowserRouter>
  );
};

export default Router;
