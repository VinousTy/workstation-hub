import React from "react";
import { createRoot } from "react-dom/client";
import { Provider } from "react-redux";
import { store } from "./features/store";
import App from "./App";

const Index = () => {
  return (
    <Provider store={store}>
      <App />
    </Provider>
  );
};

const root = createRoot(document.getElementById("root") as HTMLElement);
root.render(<Index />);
