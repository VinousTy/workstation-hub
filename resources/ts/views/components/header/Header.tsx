import React from "react";
import { Link } from "react-router-dom";
import { AiOutlineSearch } from "react-icons/ai";
import logo from "../../../assets/header/logo__header.png";

const Header = () => {
  return (
    <header className="left-0 w-full bg-white z-10 bg-header-color">
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
      </div>
    </header>
  );
};

export default Header;
