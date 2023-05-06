import React from "react";
import { useNavigate } from "react-router-dom";

const SettingsItem = () => {
  const navigate = useNavigate();

  return (
    <div className="w-1/3 mr-4">
      <h3 className="text-xl font-semibold text-gray-300 mb-4">設定</h3>
      <ul className="divide-y divide-gray-200">
        <li className="py-4 hover:bg-gray-700 transition cursor-pointer">
          <a onClick={() => navigate("/settings/account")} className="block">
            <span className="text-sm font-medium text-gray-300">
              アカウント設定
            </span>
          </a>
        </li>
        <li className="py-4 hover:bg-gray-700 transition cursor-pointer">
          <a onClick={() => navigate("/settings/profile")} className="block">
            <span className="text-sm font-medium text-gray-300">
              プロフィール設定
            </span>
          </a>
        </li>
        <li className="py-4 hover:bg-gray-700 transition cursor-pointer">
          <a
            onClick={() => navigate("/settings/notification")}
            className="block"
          >
            <span className="text-sm font-medium text-gray-300">
              お知らせ設定
            </span>
          </a>
        </li>
      </ul>
    </div>
  );
};

export default SettingsItem;
