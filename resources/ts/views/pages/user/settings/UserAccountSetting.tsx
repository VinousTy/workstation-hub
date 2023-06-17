import React, { useEffect } from "react";
import { useSelector } from "react-redux";
import { useNavigate } from "react-router-dom";
import {
  getAuthUser,
  selectUser,
} from "../../../../features/user/auth/authSlice";
import { AppDispatch } from "../../../../features/store";
import { useDispatch } from "react-redux";
import SettingsItem from "../../../components/settings/SettingsItem";

const UserAccountSetting = () => {
  const dispatch: AppDispatch = useDispatch();
  const user = useSelector(selectUser);
  const navigate = useNavigate();

  useEffect(() => {
    dispatch(getAuthUser());
  }, [dispatch]);

  return (
    <div className="bg-application-all min-h-screen">
      <div className="max-w-5xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <h1 className="text-2xl font-semibold text-gray-300 mb-8">
          アカウント設定
        </h1>
        <div className="flex">
          <SettingsItem />
          <div className="w-2/3 bg-opacity-black">
            <div className="shadow overflow-hidden sm:rounded-lg">
              <div className="px-4 py-5 sm:px-6">
                <h2 className="text-lg leading-6 font-medium text-gray-300">
                  アカウント設定
                </h2>
                <p className="mt-1 max-w-2xl text-sm text-gray-500">
                  下記のフォームに必要事項をご入力ください。
                </p>
              </div>
              <div className="border-t border-gray-200">
                <dl>
                  <div className="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt className="text-sm font-medium text-gray-300">
                      アカウント名
                    </dt>
                    <dd className="flex items-center mt-1 text-sm text-gray-500 sm:mt-0 sm:col-span-2">
                      <span className="mr-2">{user?.name}</span>
                      <span className="rounded-md shadow-sm">
                        <button
                          onClick={() => navigate("/settings/name")}
                          type="button"
                          className="inline-flex items-center px-3 py-1.5 border border-gray-300 leading-5 font-medium rounded-md text-gray-300 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition"
                        >
                          アカウント名変更
                        </button>
                      </span>
                    </dd>
                  </div>
                  <div className="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt className="text-sm font-medium text-gray-300">
                      メールアドレス
                    </dt>
                    <dd className="flex items-center mt-1 text-sm text-gray-500 sm:mt-0 sm:col-span-2">
                      <span className="mr-2">{user?.email}</span>
                      <span className="rounded-md shadow-sm">
                        <button
                          onClick={() => navigate("/settings/email")}
                          type="button"
                          className="inline-flex items-center px-3 py-1.5 border border-gray-300 leading-5 font-medium rounded-md text-gray-300 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition"
                        >
                          メールアドレス変更
                        </button>
                      </span>
                    </dd>
                  </div>
                  <div className="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt className="text-sm font-medium text-gray-300">
                      パスワード
                    </dt>
                    <dd className="flex items-center mt-1 text-sm text-gray-500 sm:mt-0 sm:col-span-2">
                      <span className="mr-2">パスワードは表示されません</span>
                      <span className="rounded-md shadow-sm">
                        <button
                          onClick={() => navigate("/settings/password")}
                          type="button"
                          className="inline-flex items-center px-3 py-1.5 border border-gray-300 leading-5 font-medium rounded-md text-gray-300 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition"
                        >
                          パスワード変更
                        </button>
                      </span>
                    </dd>
                  </div>
                </dl>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default UserAccountSetting;
