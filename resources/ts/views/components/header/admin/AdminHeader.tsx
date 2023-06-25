import React, { useEffect, useRef, useState } from "react";
import { Link } from "react-router-dom";
import logo from "../../../../assets/header/logo__header.png";
import { useSelector } from "react-redux";
import { selectIsLoggedIn } from "../../../../features/admin/auth/authSlice";
import { FaUserCircle } from "react-icons/fa";
import AdminDropdownMenu from "../../menu/AdminDropdownMenu";

const AdminHeader = () => {
  const [isDropdownOpen, setIsDropdownOpen] = useState(false);
  const isLoginedIn = useSelector(selectIsLoggedIn);
  const dropdownRef = useRef<HTMLDivElement>(null);

  const toggleDropdown = () => {
    setIsDropdownOpen(!isDropdownOpen);
  };

  const handleClickOutside = (event: MouseEvent) => {
    if (
      dropdownRef.current &&
      !dropdownRef.current.contains(event.target as Node)
    ) {
      setIsDropdownOpen(false);
    }
  };

  // dropdownの外側がクリックされた際に、dropdownを閉じる
  useEffect(() => {
    document.addEventListener("mousedown", handleClickOutside);
    return () => {
      document.removeEventListener("mousedown", handleClickOutside);
    };
  }, []);

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
            {" "}
            {/* ログイン/ログアウトの部分を右寄せするための要素 */}
            {isLoginedIn ? (
              <div className="relative">
                <FaUserCircle
                  className="text-gray-300 w-8 h-8 cursor-pointer"
                  onClick={toggleDropdown}
                />
                {isDropdownOpen && (
                  <div className="dropdown absolute -right-20 -top-5 mt-2 w-48 bg-white rounded-md shadow-lg">
                    <AdminDropdownMenu toggleDropdown={toggleDropdown} />
                  </div>
                )}
              </div>
            ) : (
              <Link
                to="/admin/login"
                className="text-gray-300 py-2 px-4 hover:text-white transition"
              >
                ログイン
              </Link>
            )}
          </div>
        </div>
      </nav>
    </header>
  );
};

export default AdminHeader;
