import React from "react";
import { Link } from "react-router-dom";
import logo from "../../../../assets/header/logo__header.png";

const AdminHeader = () => {
  return (
    <header className="left-0 w-full z-10 bg-header-color">
      <nav className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex items-center justify-between h-16">
          <div className="flex items-center">
            <div className="flex-shrink-0">
              <img className="w-32 md:w-40" src={logo} alt="Logo" />
            </div>
            <div className="hidden md:block">
              <div className="ml-10 flex items-center space-x-4">
                <p className="text-gray-300 px-3 py-2 rounded-md text-sm font-medium -ml-8">
                  管理画面
                </p>
              </div>
            </div>
          </div>
          <div className="ml-auto">
            <Link
              to="/admin/login"
              className="text-gray-300 py-2 px-4 hover:text-white transition"
            >
              ログイン
            </Link>
          </div>
        </div>
      </nav>
    </header>
  );
};

export default AdminHeader;
