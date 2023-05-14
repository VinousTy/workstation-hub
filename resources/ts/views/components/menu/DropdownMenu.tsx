import React from "react";
import { FaUserCircle } from "react-icons/fa";
import { BsFillFileEarmarkPostFill } from "react-icons/bs";
import { AiFillSetting } from "react-icons/ai";
import { BiLogOut } from "react-icons/bi";
import { Link, useNavigate } from "react-router-dom";
import { AppDispatch } from "../../../features/store";
import { useDispatch } from "react-redux";
import { userLogout } from "../../../features/auth/authSlice";
import { presistProfileConfig } from "../../../features/store";
import sessionStorage from "redux-persist/es/storage/session";

interface PROPS {
  toggleDropdown: () => void;
}

const DropdownMenu: React.FC<PROPS> = (props) => {
  const dispatch: AppDispatch = useDispatch();
  const navigate = useNavigate();
  const presistKey = presistProfileConfig.key;

  const logout = async () => {
    await dispatch(userLogout())
      .unwrap()
      .then((res) => {
        sessionStorage.removeItem(`persist:${presistKey}`);
        navigate("/login");
      });
  };

  return (
    <div className="!z-50 absolute border border-gray-300 top-20 right-4 bg-header-color w-48 rounded-lg shadow-md">
      <Link
        to="/mypage"
        className="text-gray-300 block px-4 py-2 hover:bg-green-800 transition rounded-t-lg flex items-center"
        onClick={props.toggleDropdown}
      >
        <FaUserCircle className="text-lg" />
        <span className="ml-1">マイページ</span>
      </Link>

      <Link
        to="/post"
        className="text-gray-300 block px-4 py-2 hover:bg-green-800 transition flex items-center"
        onClick={props.toggleDropdown}
      >
        <BsFillFileEarmarkPostFill />
        <span className="ml-1">投稿</span>
      </Link>

      <Link
        to="/settings/account"
        className="text-gray-300 block px-4 py-2 hover:bg-green-800 transition flex items-center"
        onClick={props.toggleDropdown}
      >
        <AiFillSetting />
        <span className="ml-1">設定</span>
      </Link>

      <Link
        to="/logout"
        className="text-gray-300 block px-4 py-2 hover:bg-green-800 transition rounded-b-lg flex items-center"
        onClick={logout}
      >
        <BiLogOut />
        <span className="ml-1">ログアウト</span>
      </Link>
    </div>
  );
};

export default DropdownMenu;
