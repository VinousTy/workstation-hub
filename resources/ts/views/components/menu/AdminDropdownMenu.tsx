import React from "react";
import { BiLogOut } from "react-icons/bi";
import { Link, useNavigate } from "react-router-dom";
import { AppDispatch, persistAdminAuthConfig } from "../../../features/store";
import { useDispatch } from "react-redux";
import sessionStorage from "redux-persist/es/storage/session";
import { adminLogout } from "../../../features/admin/auth/authSlice";

interface PROPS {
  toggleDropdown: () => void;
}

const AdminDropdownMenu: React.FC<PROPS> = (props) => {
  const dispatch: AppDispatch = useDispatch();
  const navigate = useNavigate();
  const presistKey = persistAdminAuthConfig.key;

  const logout = async () => {
    await dispatch(adminLogout())
      .unwrap()
      .then((res) => {
        sessionStorage.removeItem(`persist:${presistKey}`);
        navigate("/admin/login");
      });
  };

  return (
    <div className="!z-50 absolute border border-gray-300 top-20 right-4 bg-header-color w-48 rounded-lg shadow-md">
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

export default AdminDropdownMenu;
