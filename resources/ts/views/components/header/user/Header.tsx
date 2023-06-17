import React, { useEffect, useRef, useState } from "react";
import { Link } from "react-router-dom";
import { AiOutlineSearch } from "react-icons/ai";
import logo from "../../../../assets/header/logo__header.png";
import { useSelector } from "react-redux";
import { selectIsLoggedIn } from "../../../../features/user/auth/authSlice";
import { AiOutlineShoppingCart, AiOutlineBell } from "react-icons/ai";
import { FaUserCircle } from "react-icons/fa";
import DropdownMenu from "../../menu/DropdownMenu";
import { selectProfileImage } from "../../../../features/user/profile/profileSlice";

const Header = () => {
  const [isDropdownOpen, setIsDropdownOpen] = useState(false);
  const filePath = useSelector(selectProfileImage);
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
      <div className="container mx-auto flex justify-between items-center py-2">
        {/* ロゴ */}
        <Link to="/">
          <img className="w-32 md:w-40" src={logo} alt="Logo" />
        </Link>

        {/* 検索バー */}
        <form className="relative">
          <input
            type="text"
            className="bg-stone-900 border-2 border-stone-800 rounded-full py-2 pr-48 pl-10 block w-full max-w-full appearance-none leading-normal"
            placeholder="お好きなアイテムを探す"
          />
          <div className="absolute top-1 left-2 mt-2 ml-3">
            <AiOutlineSearch className="text-lg fill-current pointer-events-none text-gray-500" />
          </div>
        </form>

        {/* ナビゲーションバー */}
        {isLoginedIn ? (
          <nav className="flex items-center">
            {filePath ? (
              <img
                src={filePath}
                alt="User Icon"
                className="w-8 h-8 rounded-full object-cover cursor-pointer"
                onClick={toggleDropdown}
              />
            ) : (
              <FaUserCircle
                className="text-gray-300 w-8 h-8 cursor-pointer"
                onClick={toggleDropdown}
              />
            )}
            {isDropdownOpen && (
              <div className="dropdown" ref={dropdownRef}>
                <DropdownMenu toggleDropdown={toggleDropdown} />
              </div>
            )}
            <Link to="/cart">
              <AiOutlineShoppingCart className="text-2xl text-gray-300 ml-4 hover:text-white transition" />
            </Link>
            <Link to="/notifications">
              <AiOutlineBell className="text-2xl text-gray-300 ml-4 hover:text-white transition" />
            </Link>
          </nav>
        ) : (
          <nav className="flex items-center">
            <Link
              to="/login"
              className="text-gray-300 py-2 px-4 hover:text-white transition"
            >
              ログイン
            </Link>

            <Link
              to="/contact"
              className="relative text-gray-300 py-2 px-4 hover:text-white transition"
            >
              お問い合わせ
            </Link>
          </nav>
        )}
      </div>
    </header>
  );
};

export default Header;
